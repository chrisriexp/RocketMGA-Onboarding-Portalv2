<template>
    <div class="grid gap-8 mt-8 px-12 py-6 w-fit h-fit mx-auto shadow-newdrop rounded-xl bg-white">
        <!--Headers-->
        <div class="grid gap-4">
            <h2 class="text-[25px] font-medium text-custom-gray text-center">RocketMGA Onboarding Portal</h2>
            <h3 v-if="!needCode" class="text-[15px] text-custom-gray text-center">If you have already entered your email you can <br> pickup right where you left off!</h3>
            <h3 v-else class="text-[15px] text-custom-gray text-center">Please enter the verification code sent to your email.</h3>
        </div>

        <!--Inputs-->
        <div class="flex gap-4 w-fit mx-auto">
            <!--Email-->
            <div class="grid gap-2">
                <input v-model="v$.email.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.email.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.email.$error}" required type="email" name="email" id="email" placeholder="Email" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                <div class="input-errors" v-for="(error, index) of v$.email.$errors" :key="index">
                    <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                </div>
            </div>
            
            <!--Verification Code-->
            <div class="grid gap-2">
                <input v-if="needCode" v-model="v$.userCode.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.userCode.$error, 'border-custom-blue focus:border-custom-blue focus:ring-custom-blue': !v$.userCode.$error}" type="text" name="userCode" id="userCode" placeholder="Verification Code" class="h-[50px] w-[300px] rounded-md border-[3px] p-2">
                <div class="input-errors" v-for="(error, index) of v$.userCode.$errors" :key="index">
                    <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                </div>
            </div>
        </div>

        <!--Buttons-->
        <button v-if="!needCode" v-on:click="login()" class="w-fit mx-auto bg-custom-blue py-2 px-6 text-white font-semibold rounded-md uppercase">Start</button>
        <button v-else v-on:click="verifyEmail()" class="w-fit mx-auto bg-custom-blue py-2 px-6 text-white font-semibold rounded-md uppercase">Verify Email</button>
    </div>
</template>

<script>
import emailjs from '@emailjs/browser';
import { useVuelidate } from '@vuelidate/core'
import { required, email, sameAs, helpers} from '@vuelidate/validators'

export default {
    name: 'Login',
    setup () {
        return {
            v$: useVuelidate()
        }
    },
    data () {
        return {
            verificationEmailTemplate: 'template_771e0me',
            serviceID: 'service_nf9yozb',
            publicKey: 'h29zXRTKkaswfKPkp',
            needCode: false,
            email: '',
            emailCode: '',
            userCode: '',
            userID: '',
            rocketMGA_id: '',
            submitted: false
        }
    },
    methods: {
        async login() {
            let users = ''

            await axios.get('/api/users')
            .then(response => {
                users = response.data.length
                response.data.forEach(user => {
                    //User in Database
                    if(user.email === this.email.toLowerCase()){
                        this.userID = user.id.toString()
                        this.submitted = user.submitted
                        this.needCode = true
                        //Create Verification Code
                        this.emailCode = Math.floor(Math.random()*90000).toString()
                        
                        //Send Verification Code Email
                        emailjs.init(this.publicKey)
                        emailjs.send(this.serviceID, this.verificationEmailTemplate, {
                        toEmail: this.email,
                        verificationCodeEmail: this.emailCode
                        })

                        return
                    } else {
                        return
                    }
                });
            })

            //Create New User not in Database
            //Create RMGA ID
            const val = 13600 + users + 1
            this.rocketMGA_id = `RMGA${val}`

            if(!this.needCode){
                axios.post('/api/user/add', {
                    "user": {
                        "email": this.email.toLowerCase(),
                        "rocketMGA_id": this.rocketMGA_id,
                        "stage": "portal_agency_info"
                    }
                })
                .then(response => { 
                    this.userID = response.data.id.toString()
                    this.$emit('userLoggedIn', this.userID);
                })
            }
        },
        verifyEmail() {
            if(this.userCode === this.emailCode){
                this.$emit('userLoggedIn', this.userID);
                return
            } else {
                alert("The verification code was incorrect, please try again.")
                return
            }
        }
    },
    validations () {
        return {
            email: {required: helpers.withMessage('Email is required.', required), email: helpers.withMessage('Please enter a vaild email.', email)},
            userCode: {required: helpers.withMessage('Verification code required.', required), sameAsRef: helpers.withMessage('Incorrect verification code.', sameAs(this.emailCode))}
        }
    }
}
</script>