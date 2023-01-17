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
                
                <div class="flex gap-4 py-2 px-6 rounded-xl bg-custom-red text-white">
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
                <div class="grid gap-4">
                    <h1 class="text-3xl text-custom-gray">Onboarding Documents!</h1>
                    <p class="text-custom-gray opacity-50">Here is some important information for you:</p>
                </div>

                <div id="loading" class="w-fit ml-[600px] absolute z-10 mt-64 hidden">
                    <loading class="w-fit" />
                </div>

                <!--Agent Documents-->
                <div class="grid bg-white w-full rounded-xl p-6 gap-2">
                    <div class="grid h-fit gap-4">
                        <div class="flex gap-4">
                            <h2 class="text-custom-gray float-left text-xl font-bold px-2">Agent Documents</h2>
                            <ArrowPathIcon @click="resetFilter()" class="w-4 h-4 text-custom-gray my-auto hover:cursor-pointer" />
                        </div>

                        <!--Headers-->
                        <div class="grid grid-cols-4 w-full h-fit text-sm text-custom-gray font-medium opacity-50 border-b-2 py-4 px-2">
                            <input @change="agencyFilter()" v-model="agency" type="text" name="Agency" id="Agency" placeholder="Agency" class="border-0 text-sm p-0">
                            <p class="grid col p-0">Logo</p>
                            <p class="grid col p-0">E&O</p>
                            <p class="grid col p-0">Agreement</p>
                        </div>

                        <!--Agents-->
                        <div class="h-[500px] overflow-y-scroll">
                            <div v-for="(agent, index) in filterView" :key="index" class="grid grid-cols-4 w-full h-fit p-2 rounded-xl text-sm text-custom-gray font-semibold hover:bg-custom-gray hover:bg-opacity-5">
                                <!--Agency Name-->
                                <div class="grid col">
                                    <p @click="gotoAgent(agent.id, agent.rocketID)" class="hover:cursor-pointer">{{ agent.agency }}</p>
                                </div>

                                <!--Agency Logo-->
                                <div class="grid col">
                                    <p v-if="agent.logo == null" class="opacity-40">No Logo</p>
                                    <a v-else target="_blank" :href="agent.logo" class="text-custom-red">Click to view</a>
                                </div>
                                
                                <!--Agent E&O-->
                                <div class="grid col">
                                    <p v-if="agent.eo == null" class="opacity-40">No E&O</p>
                                    <a v-else target="_blank" :href="agent.eo" class="text-custom-red">Click to view</a>
                                </div>

                                <!--Agency Agreement-->
                                <div class="grid col">
                                    <p v-if="agent.agreement == null" class="opacity-40">No Agreement</p>
                                    <p @click="downloadAgreement(agent.agreement, agent.agency, agent.rocketID)" v-else class="text-custom-red hover:cursor-pointer">Click to download</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {UserCircleIcon, HomeIcon, DocumentTextIcon, ArrowLeftOnRectangleIcon, ArrowRightCircleIcon, CheckBadgeIcon, ReceiptPercentIcon, ArrowPathIcon} from '@heroicons/vue/24/outline'
import loading from '../components/loading-red.vue'
import moment from 'moment';

export default {
    name: "Onboarding Documents",
    data() {
        return {
            apiKey: '8135da5570abd90097a2bcc0dbbce76d1decd484',
            date: '',
            users: [],
            userDocuments: [],
            logopath: '',
            eopath: '',
            filterView: [],
            agency: ''
        }
    },
    props: {
        adminID: String
    },
    created: async function() {
        //Check to see if admin account is logged in
        await axios.get('/api/admin/status/' + this.adminID)
        .then(response => {
            if(!response.data.login){
                this.$router.push({name: 'AdminLogin'})
            }
        })

        await axios.get('/api/users')
        .then(response => {
            response.data.forEach(user => {
                this.users.push({id: user.id, rocketID: user.rocketMGA_id, agency: user.agency_name, logo: user.agency_logo, eo: user.eo, agreement: user.document_id})
            })
        })

        for await (const user of this.users) {
            if(user.logo != null){
                await axios.get('/api/file/' + user.logo)
                .then(response => {this.logopath = "http://localhost:8000" + response.data.path})
            } else {
                this.logopath = null
            }

            if(user.eo != null){
                await axios.get('/api/file/' + user.eo)
                .then(response => {this.eopath = "http://localhost:8000" + response.data.path})
            } else {
                this.eopath = null
            }

            this.userDocuments.push({id: user.id, rocketID: user.rocketID, agency: user.agency, logo: this.logopath, eo: this.eopath, agreement: user.agreement})

            this.logopath = '' 
            this.eopath = ''
        }

        this.filterView = this.userDocuments

        this.moment = moment;
        this.date = new Date()//.toLocaleString()
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
        gotoAppointedAgents(){
            this.$router.push({name: 'AppointedAgents', params: {adminID: this.adminID}})
        },
        gotoAgent(id, rocketID){
            this.$router.push({name: 'Subagent', params: {adminID: this.adminID, userID: id, rocketID: rocketID}})
        },
        async downloadAgreement(id, agency, rocketID){
            //Show Loading Spinner
            document.getElementById("loading").classList.remove("hidden")

            const myHeaders = {
                headers: {'Authorization': `API-Key ${this.apiKey}`, 'Content-Type': 'application/pdf'},
                responseType: 'blob'
            }

            await axios.get(`https://api.pandadoc.com/public/v1/documents/${id}/download`, myHeaders)
            .then(response => {
                console.log(response)
                const url = window.URL.createObjectURL(new Blob([response.data], {type:"application/pdf"}));
                const link = document.createElement('a');
                link.href = url;
                window.open(url);
                link.setAttribute('download', `${agency}-${rocketID}.pdf`);
                document.body.appendChild(link);
                link.click();
            })

            //Hide Loading Spinner
            document.getElementById("loading").classList.add("hidden")
        },
        agencyFilter(){
            this.filterView = []
            this.users.forEach(user => {
                if(user.agency.toLowerCase().includes(this.agency.toLowerCase())){
                    this.filterView.push(user)
                }
            })
        },
        resetFilter(){
            this.agency = ''
            this.filterView = this.userDocuments
        }
    },
    components: {
        loading,
        UserCircleIcon,
        HomeIcon,
        DocumentTextIcon,
        ArrowLeftOnRectangleIcon,
        ArrowRightCircleIcon,
        CheckBadgeIcon,
        ReceiptPercentIcon,
        ArrowPathIcon
    }
}
</script>