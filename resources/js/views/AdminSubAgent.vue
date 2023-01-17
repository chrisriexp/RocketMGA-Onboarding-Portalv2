<template>
    <div class="grid grid-cols-10 w-full h-screen">
        <!--Side Nav Bar-->
        <div class="grid col-span-2 bg-white justify-items-center gap-10 h-fit w-full px-8">
            <!--Red MGA Logo-->
            <div class="border-custom-gray border-b-2 h-fit border-opacity-10 w-full">
                <img src="../assets/logo-red.svg" alt="RocketMGA Logo" class="h-[30px] mx-auto my-6">
            </div>

            <!--Nav Sidebar-->
            <div class="grid h-fit justify-items-left gap-6 w-full">
                <div @click="gotoDashboard()" class="flex gap-4 py-2 px-6 rounded-xl text-custom-gray hover:cursor-pointer hover:bg-custom-gray hover:bg-opacity-20 hover:text-white">
                    <HomeIcon class="h-6 w-6" /> 
                    <p class="text-md font-semibold">Dashboard</p>
                </div>

                <div @click="gotoOnboardingAgents()" class="flex gap-4 py-2 px-6 rounded-xl text-custom-gray hover:cursor-pointer hover:bg-custom-gray hover:bg-opacity-20 hover:text-white">
                    <UserCircleIcon class="h-6 w-6" /> 
                    <p class="text-md font-semibold">Onboarding Agents</p>
                </div>
                
                <div @click="gotoOnboardingDocuments()" class="flex gap-4 py-2 px-6 rounded-xl text-custom-gray hover:cursor-pointer hover:bg-custom-gray hover:bg-opacity-20 hover:text-white">
                    <DocumentTextIcon class="h-6 w-6" /> 
                    <p class="text-md font-semibold">Onboarding Documents</p>
                </div>

                <div @click="gotoAppointedAgents()" class="flex gap-4 py-2 px-6 rounded-xl text-custom-gray hover:cursor-pointer hover:bg-custom-gray hover:bg-opacity-20 hover:text-white">
                    <CheckBadgeIcon class="h-6 w-6" /> 
                    <p class="text-md font-semibold">Appointed Agents</p>
                </div>

                <div class="flex gap-4 py-2 px-6 text-custom-gray hover:cursor-pointer">
                    <ArrowLeftOnRectangleIcon class="h-6 w-6" /> 
                    <p @click="logout()" class="text-md font-semibold">Sign Out</p>
                </div>
            </div>

            <!--Sidebar Footer-->
            <div class="grid justify-items-center bottom-0 fixed gap-4 mb-4">
                <p class="w-fit mx-auto h-fit my-auto text-sm">© 2023 <a target="_blank" href="https://rocketmga.com">ROCKETMGA.COM</a></p>
                <div class=" flex gap-4 w-fit mx-auto h-fit my-auto text-sm">
                    <p>ALL RIGHTS RESERVED</p>
                    <div class="w-[8px] h-[8px] bg-custom-gray rounded-[50%] my-auto bg-opacity-50"></div>
                    <a target="_blank" href="https://rocketmga.com/privacy-policy/">PRIVACY POLICY</a>
                </div>
            </div>
        </div>

        <!--Body-->
        <div class="gird col-span-8 bg-[#f5f5f5]">
            <!--Header with Date and Time-->
            <div class="border-custom-gray border-b-2 h-fit border-opacity-10">
                <div class="h-[30px] my-6 flow root">
                    <p class="float-right bg-white px-4 py-2 rounded-xl mr-16 text-sm">{{ moment(date).format("dddd, MMMM Do YYYY, h:mm a") }}</p>
                </div>
            </div>

            <!--Body-->
            <div class="grid gap-4 mx-10 my-10">
                <!--Welcome Msg-->
                <div class="grid gap-2">
                    <h1 class="text-3xl font-bold text-custom-gray">{{data.agency_name}} - {{ data.rocketMGA_id }}</h1>
                    <div class="flex gap-10 w-fit text-lg text-custom-gray">
                        <h2><span class="font-medium">DBA</span> - {{ data.dba_name }}</h2>
                        <h2><span class="font-medium">Principal Agent</span> - {{ data.agent_name }}</h2>
                        <div v-if="data.stage == 'portal_agency_info' && !data.submitted" class="flex w-fit gap-4">
                            <h2 class="font-medium">Stage</h2>
                            <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                            <p>Agency Information</p>
                        </div>
                        <div v-else-if="data.stage == 'portal_appointment_info' && !data.submitted" class="flex w-fit gap-4">
                            <h2 class="font-medium">Stage</h2>
                            <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                            <p>Carrier and State Information</p>
                        </div>
                        <div v-else-if="data.stage == 'portal_entity_info' && !data.submitted" class="flex w-fit gap-4">
                            <h2 class="font-medium">Stage</h2>
                            <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                            <p>Entity Information</p>
                        </div>
                        <div v-else-if="data.stage == 'portal_eo_info' && !data.submitted" class="flex w-fit gap-4">
                            <h2 class="font-medium">Stage</h2>
                            <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                            <p>E&O Information</p>
                        </div>
                        <div v-else-if="data.stage == 'portal_agreement' && !data.submitted" class="flex w-fit gap-4">
                            <h2 class="font-medium">Stage</h2>
                            <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                            <p>Agreement</p>
                        </div>
                        <div v-else-if="data.submitted" class="flex w-fit gap-4">
                            <h2 class="font-medium">Stage</h2>
                            <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                            <p>Completed</p>
                        </div>
                    </div>
                    <p class="text-custom-gray opacity-50">Here is some important information for you:</p>
                </div>

                <div id="loading" class="w-fit ml-[600px] absolute z-10 mt-64 hidden">
                    <loading class="w-fit" />
                </div>

                <!--Carrier UIPs-->
                <div class="grid bg-white w-full rounded-xl p-6 gap-4 h-fit">
                    <div class="flex flow-root gap-10">
                        <h2 class="text-custom-gray float-left text-xl font-bold my-auto float-left">Carrier UIPs</h2>
                        <button :disabled="uip_disabled" @click="saveCarriers()" class="text-white bg-custom-red rounded-xl font-medium text-sm p-2 my-auto uppercase float-right disabled:opacity-30">save</button>
                    </div>

                    <div class="grid grid-cols-8 w-full text-sm text-custom-gray font-medium opacity-50 border-b-2 border-custom-gray border-opacity-20 pb-4">
                        <p>Aon</p>
                        <p>Beyond</p>
                        <p>Dual</p>
                        <p>Flow</p>
                        <p>Neptune</p>
                        <p>Palomar</p>
                        <p>Sterling</p>
                        <p>Wright</p>
                    </div>

                    <div class="grid grid-cols-8 w-full text-sm text-custom-gray">
                        <input :disabled="uip_disabled" type="text" v-model="aon" class="mr-10 border-custom-gray rounded-xl focus:border-custom-red">
                        <input :disabled="uip_disabled" type="text" v-model="beyond" class="mr-10 border-custom-gray rounded-xl focus:border-custom-red">
                        <input :disabled="uip_disabled" type="text" v-model="dual" class="mr-10 border-custom-gray rounded-xl focus:border-custom-red">
                        <input :disabled="uip_disabled" type="text" v-model="flow" class="mr-10 border-custom-gray rounded-xl focus:border-custom-red">
                        <input :disabled="uip_disabled" type="text" v-model="neptune" class="mr-10 border-custom-gray rounded-xl focus:border-custom-red">
                        <input :disabled="uip_disabled" type="text" v-model="palomar" class="mr-10 border-custom-gray rounded-xl focus:border-custom-red">
                        <input :disabled="uip_disabled" type="text" v-model="sterling" class="mr-10 border-custom-gray rounded-xl focus:border-custom-red">
                        <input :disabled="uip_disabled" type="text" v-model="wright" class="mr-10 border-custom-gray rounded-xl focus:border-custom-red">
                    </div>
                </div>

                <!--Agency and License Information with Downloads Section-->
                <div class="grid grid-cols-4 gap-24 w-full">
                    <div class="grid col-span-3 w-full gap-4">
                        <!--Agency Information-->
                        <div class="grid bg-white w-full rounded-xl p-6 gap-4 h-fit">
                            <h2 class="text-custom-gray float-left text-xl font-bold">Agency Information</h2>

                            <div class="flex gap-6 font-medium">
                                <p>{{ data.phone }}</p>
                                <p>{{ data.email }}</p>
                                <p>{{ data.address }}</p>
                            </div>
                        </div>

                        <!--License Information-->
                        <div class="grid bg-white w-full rounded-xl p-6 gap-4 h-fit">
                            <h2 class="text-custom-gray float-left text-xl font-bold">Licensing and E&O Information</h2>

                            <div class="flex gap-10">
                                <p><span class="font-medium">Agency License </span>{{ data.agency_license }}</p>
                                <p><span class="font-medium">Agency Tax ID </span>{{ data.agency_tax_id }}</p>
                                <p><span class="font-medium">Agency Type </span>{{ data.agency_type }}</p>
                            </div>

                            <div class="flex gap-10">
                                <p><span class="font-medium">Agent License </span>{{ data.agent_license }} <span class="font-medium">from</span> {{ data.agent_license_eff }} <span class="font-medium">to</span> {{ data.agent_license_exp }}</p>
                                <p><span class="font-medium">Agent NPN </span>{{ data.agent_npn }}</p>
                            </div>

                            <div class="flex gap-10">
                                <p><span class="font-medium">E&O Insurer </span>{{ data.eo_insurer }}</p>
                                <p><span class="font-medium">E&O Limit </span>${{ data.eo_limit }}</p>
                                <p><span class="font-medium">E&O Policy </span>{{ data.eo_policy }}</p>
                                <p><span class="font-medium">E&O Exp </span>{{ data.eo_exp }}</p>
                            </div>
                        </div>
                    </div>

                    <!--Downloads-->
                    <div class="grid col bg-white w-full rounded-xl p-6">
                        <div class="grid h-fit w-full gap-6">
                            <h2 class="text-custom-gray float-left text-xl font-bold">Documents</h2>

                            <div class="rounded-xl p-2 font-medium text-custom-gray text-sm hover:bg-custom-red hover:text-white">
                                <a target="_blank" :href="this.logoPath" class="flex gap-4 my-auto">
                                    <ArrowDownTrayIcon class="h-[20px] w-[20px] my-auto" />
                                    <p class="my-atuo">Agency Logo</p>
                                </a>
                            </div>

                            <div class="rounded-xl p-2 font-medium text-custom-gray text-sm hover:bg-custom-red hover:text-white">
                                <a target="_blank" :href="this.eoPath" class="flex gap-4 my-auto">
                                    <ArrowDownTrayIcon class="h-[20px] w-[20px] my-auto" />
                                    <p class="my-atuo">Agency E&O</p>
                                </a>
                            </div>

                            <button @click="downloadAgreement()" :disabled="agreement_disabled" class="flex gap-4 my-auto rounded-xl p-2 font-medium text-custom-gray text-sm hover:bg-custom-red hover:text-white">
                                <ArrowDownTrayIcon class="h-[20px] w-[20px] my-auto" />
                                <p class="my-atuo">Agency Agreement</p>
                            </button>
                        </div>
                    </div>
                </div>

                <!--Appointed States and Carriers-->
                <div class="grid bg-white w-full rounded-xl p-6 gap-4 h-fit">
                    <div class="flex gap-4 font-medium">
                        <h2 class="text-custom-gray text-lg font-semibold p-2">Appointed States</h2>
                        <p v-for="(state, index) in states" :key="index" class="p-2 text-white bg-custom-red rounded-xl text-sm h-fit w-fit my-auto">{{ state }}</p>
                    </div>

                    <div class="flex gap-4 font-medium">
                        <h2 class="text-custom-gray text-lg font-semibold p-2">Carriers</h2>
                        <p v-for="(carrier, index) in carriers" :key="index" class="p-2 text-white bg-custom-red rounded-xl text-sm h-fit w-fit my-auto">{{ carrier }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
import loading from '../components/loading-red.vue'
import {UserCircleIcon, HomeIcon, DocumentTextIcon, ArrowLeftOnRectangleIcon, ArrowRightCircleIcon, CheckBadgeIcon, ReceiptPercentIcon, ArrowDownTrayIcon} from '@heroicons/vue/24/outline'


export default {
    name: "Subagent",
    data() {
        return {
            apiKey: '8135da5570abd90097a2bcc0dbbce76d1decd484',
            date: '',
            data: {},
            logoPath: '',
            eoPath: '',
            agreement_disabled: false,
            uip_disabled: true,
            states: [],
            carriers: [],
            aon: '',
            beyond: '',
            dual: '',
            flow: '',
            neptune: '',
            palomar: '',
            sterling: '',
            wright: ''
        }
    },
    props: {
        adminID: String,
        userID: String, 
        rocketID: String
    },
    created: async function() {
        this.moment = moment
        this.date = new Date()

        //Check to see if admin account is logged in
        await axios.get('/api/admin/status/' + this.adminID)
        .then(response => {
            if(!response.data.login){
                this.$router.push({name: 'AdminLogin'})
            }
        })

        await axios.get('/api/user/' + this.userID)
        .then(response => {this.data = response.data})

        await axios.get('/api/file/' + this.data.agency_logo)
        .then(response => {this.logoPath = "http://localhost:8000" + response.data.path})

        await axios.get('/api/file/' + this.data.eo)
        .then(response => {this.eoPath = "http://localhost:8000" + response.data.path})

        if(this.data.submitted){
            await axios.get('/api/appointed/' + this.rocketID)
            .then(response => {
                if(response.data.aon != null){this.aon = response.data.aon}
                if(response.data.beyond != null){this.beyond = response.data.beyond}
                if(response.data.dual != null){this.dual = response.data.dual}
                if(response.data.flow != null){this.flow = response.data.flow}
                if(response.data.neptune != null){this.neptune = response.data.neptune}
                if(response.data.palomar != null){this.palomar = response.data.palomar}
                if(response.data.sterling != null){this.sterling = response.data.sterling}
                if(response.data.wright != null){this.wright = response.data.wright}
            })

            this.uip_disabled = false
        } else {
            this.aon = "Not Submitted"
            this.beyond = "Not Submitted"
            this.dual = "Not Submitted"
            this.flow = "Not Submitted"
            this.neptune = "Not Submitted"
            this.palomar = "Not Submitted"
            this.sterling = "Not Submitted"
            this.wright = "Not Submitted"
        }

        this.states = this.data.additional_states.split(",")
        this.carriers = this.data.carriers.split(",")
    },
    methods: {
        async logout() {
            await axios.get('/api/admin/logout/' + this.adminID)
            window.location.reload();
        },
        gotoDashboard(){
            this.$router.push({name: 'AdminDashboard', params: {adminID: this.adminID}})
        },
        gotoOnboardingAgents(){
            this.$router.push({name: 'OnboardingAgents', params: {adminID: this.adminID}})
        },
        gotoOnboardingDocuments(){
            this.$router.push({name: 'OnboardingDocuments', params: {adminID: this.adminID}})
        },
        gotoAppointedAgents(){
            this.$router.push({name: 'AppointedAgents', params: {adminID: this.adminID}})
        },
        async downloadAgreement(){
            //Disable Agreement Button
            this.agreement_disabled = true
            //Show Loading Spinner
            document.getElementById("loading").classList.remove("hidden")

            const myHeaders = {
                headers: {'Authorization': `API-Key ${this.apiKey}`, 'Content-Type': 'application/pdf'},
                responseType: 'blob'
            }

            await axios.get(`https://api.pandadoc.com/public/v1/documents/${this.data.document_id}/download`, myHeaders)
            .then(response => {
                console.log(response)
                const url = window.URL.createObjectURL(new Blob([response.data], {type:"application/pdf"}));
                const link = document.createElement('a');
                link.href = url;
                window.open(url);
                link.setAttribute('download', `${this.data.agency_name}-${this.data.rocketMGA_id}.pdf`);
                document.body.appendChild(link);
                link.click();
            })

            //Hide Loading Spinner
            document.getElementById("loading").classList.add("hidden")
            //Enable Agreement Button
            this.agreement_disabled = false
        },
        async saveCarriers(){
            //Show loading
            document.getElementById("loading").classList.remove("hidden")
            
            await axios.put('/api/appointed/update/' + this.rocketID, {
                "aon": this.aon,
                "beyond": this.beyond,
                "dual": this.dual,
                "flow": this.flow,
                "neptune": this.neptune,
                "palomar": this.palomar,
                "sterling": this.sterling,
                "wright": this.wright
            }) 

            //Hide loading
            document.getElementById("loading").classList.add("hidden")
        }
    },
    components:{
        loading,
        UserCircleIcon,
        HomeIcon,
        DocumentTextIcon,
        ArrowLeftOnRectangleIcon,
        ArrowRightCircleIcon,
        CheckBadgeIcon,
        ReceiptPercentIcon,
        ArrowDownTrayIcon
    }
}
</script>