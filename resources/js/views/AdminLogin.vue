<template>
    <div class="w-full h-fit bg-white border-custom-gray border-b-2 border-opacity-40 z-10 relative">
        <img src="../assets/logo-red.svg" alt="RocketMGA Logo" class="h-[30px] mx-auto my-6">
    </div>

    <!--Login-->
    <div class="z-10 mx-auto relative grid gap-8 mt-48 px-8 py-6 w-fit h-fit mx-auto shadow-newdrop rounded-xl bg-white">
        <h2 class="text-[20px] font-medium text-custom-gray text-center">Admin Portal</h2>

        <div class="grid gap-8 w-fit mx-auto">
            <!--Username-->
            <div class="grid gap-2">
                <input v-model="v$.user.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.user.$error, 'border-custom-gray focus:border-custom-gray focus:ring-custom-gray focus:border-opacity-20': !v$.user.$error}" required type="text" name="user" id="user" placeholder="Username" class="h-[50px] w-[350px] rounded-md border-[1px] p-2 border-opacity-20">
                <div class="input-errors" v-for="(error, index) of v$.user.$errors" :key="index">
                    <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                </div>
            </div>

            <!--Password-->
            <div class="grid gap-2">
                <input v-model="v$.password.$model" :class="{'border-red-400 focus:border-red-400 focus:ring-red-400': v$.password.$error, 'border-custom-gray focus:border-custom-gray focus:ring-custom-gray focus:border-opacity-20': !v$.password.$error}" required type="password" name="password" id="password" placeholder="Password" class="h-[50px] w-[350px] rounded-md border-[1px] p-2 border-opacity-20">
                <div class="input-errors" v-for="(error, index) of v$.password.$errors" :key="index">
                    <div class="error-msg text-sm text-red-400">{{ error.$message }}</div>
                </div>
            </div>

            <button v-on:click="login()" class="w-full mx-auto bg-[#172340] py-2 px-6 text-white font-semibold rounded-md uppercase">Login</button>
        </div>
    </div>

    <Footer class="z-10 bottom-0 fixed" />

    <!--Background Image-->
    <div class="w-full bottom-0 fixed z-0">
        <img src="../assets/1-red.jpg" alt="Abstract Background Image">
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, email, minLength, maxLength, helpers} from '@vuelidate/validators'
import axios from 'axios'
import Header from '../components/header.vue'
import Footer from '../components/footer.vue'

export default {
    name: "Admin Login",
    setup () {
        return {
            v$: useVuelidate()
        }
    },
    data() {
        return {
            user: '',
            password: '',
            adminID: 0
        }
    },
    methods: {
        async login(){
            await axios.post('/api/admin/login', {
                "user": this.user,
                "password": this.password
            }).then(response => {
                if(response.data.error){
                    this.user = ''
                    this.password = ''
                    alert(response.data.error)
                    return
                }

                if(response.data.success){
                    this.adminID = response.data.id
                    this.$router.push({name: 'AdminDashboard', params: {adminID: this.adminID}})
                    return
                }

                
            })
        }
    },
    validations () {
        return {
            user: {required: helpers.withMessage('Username is required.', required), minLengthValue: helpers.withMessage('Username needs to be atlest 3 characters.', minLength(3))},
            password: {required: helpers.withMessage('Password is required.', required), minLengthValue: helpers.withMessage('Password needs to be atlest 8 characters.', minLength(8))},
        }
    },
    components: {
        Header,
        Footer
    }
}
</script>