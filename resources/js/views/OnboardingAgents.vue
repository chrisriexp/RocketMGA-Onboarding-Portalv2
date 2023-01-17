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

                <div class="flex gap-4 py-2 px-6 rounded-xl bg-custom-red text-white">
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
                <div class="grid gap-4">
                    <h1 class="text-3xl text-custom-gray">Onboarding Agents!</h1>
                    <p class="text-custom-gray opacity-50">Here is some important information for you:</p>
                </div>

                <!--Agent Progress-->
                <div class="grid bg-white w-full rounded-xl p-6 gap-2">
                    <div class="grid h-fit gap-4">
                        <div class="flex gap-4">
                            <h2 class="text-custom-gray float-left text-xl font-bold px-2">Agent Progress</h2>
                            <ArrowPathIcon @click="resetFilter()" class="w-4 h-4 text-custom-gray my-auto hover:cursor-pointer" />
                        </div>

                        <!--Headers-->
                        <div class="grid grid-cols-4 w-full h-fit text-sm text-custom-gray font-medium opacity-50 border-b-2 py-4 px-2">
                            <input @change="agencyFilter()" v-model="agency" type="text" name="Agency" id="Agency" placeholder="Agency" class="border-0 text-sm p-0">
                            <input @change="emailFilter()" v-model="email" type="text" name="Email" id="Email" placeholder="Email" class="border-0 text-sm p-0">
                            <input @change="agentFilter()" v-model="agent" type="text" name="Agent" id="Agent" placeholder="Agent" class="border-0 text-sm p-0">
                            <p class="grid col">Stage</p>
                        </div>

                        <!--Agents-->
                        <div class="h-[500px] overflow-y-scroll">
                            <div @click="gotoAgent(agent.id, agent.rocketID)" v-for="(agent, index) in filterView" :key="index" class="grid grid-cols-4 w-full h-fit p-2 rounded-xl text-sm text-custom-gray font-semibold hover:cursor-pointer hover:bg-custom-gray hover:bg-opacity-5">
                                <!--Agency Name-->
                                <div class="grid col">
                                    <p>{{ agent.agency }}</p>
                                </div>

                                <!--Agency Email-->
                                <div class="grid col">
                                    <p>{{ agent.email }}</p>
                                </div>
                                
                                <!--Agent Name-->
                                <div class="grid col">
                                    <p>{{ agent.agent }}</p>
                                </div>

                                <!--Agency Stage-->
                                <div class="grid col">
                                    <div v-if="agent.stage == 'portal_agency_info' && !agent.submitted" class="flex w-fit gap-4">
                                        <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                                        <p>Agency Information</p>
                                    </div>
                                    <div v-else-if="agent.stage == 'portal_appointment_info' && !agent.submitted" class="flex w-fit gap-4">
                                        <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                                        <p>Carrier and State Information</p>
                                    </div>
                                    <div v-else-if="agent.stage == 'portal_entity_info' && !agent.submitted" class="flex w-fit gap-4">
                                        <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                                        <p>Entity Information</p>
                                    </div>
                                    <div v-else-if="agent.stage == 'portal_eo_info' && !agent.submitted" class="flex w-fit gap-4">
                                        <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                                        <p>E&O Information</p>
                                    </div>
                                    <div v-else-if="agent.stage == 'portal_agreement' && !agent.submitted" class="flex w-fit gap-4">
                                        <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                                        <p>Agreement</p>
                                    </div>
                                    <div v-else-if="agent.submitted" class="flex w-fit gap-4">
                                        <div class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                                        <p>Completed</p>
                                    </div>
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
import moment from 'moment';
import {UserCircleIcon, HomeIcon, DocumentTextIcon, ArrowLeftOnRectangleIcon, ArrowRightCircleIcon, CheckBadgeIcon, ReceiptPercentIcon, ArrowPathIcon} from '@heroicons/vue/24/outline'

export default {
    name: "Onboarding Agents",
    data () {
        return {
            date: '',
            users: [],
            filterView: [],
            agency: '',
            email: '',
            agent: ''
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
                this.users.push({id: user.id, rocketID: user.rocketMGA_id, agency: user.agency_name, agent: user.agent_name, stage: user.stage, submitted: user.submitted, email: user.email})
            })
        })

        this.filterView = this.users

        this.moment = moment
        this.date = new Date()
    },
    methods: {
        async logout() {
            await axios.get('/api/admin/logout/' + this.adminID)
            window.location.reload();
        },
        gotoAgent(id, rocketID){
            this.$router.push({name: 'Subagent', params: {adminID: this.adminID, userID: id, rocketID: rocketID}})
        },
        gotoDashboard(){
            this.$router.push({name: 'AdminDashboard', params: {adminID: this.adminID}})
        },
        gotoOnboardingDocuments(){
            this.$router.push({name: 'OnboardingDocuments', params: {adminID: this.adminID}})
        },
        gotoAppointedAgents(){
            this.$router.push({name: 'AppointedAgents', params: {adminID: this.adminID}})
        },
        agencyFilter(){
            this.filterView = []
            this.users.forEach(user => {
                if(user.agency.toLowerCase().includes(this.agency.toLowerCase())){
                    this.filterView.push(user)
                }
            })
        },
        emailFilter(){
            this.filterView = []
            this.users.forEach(user => {
                if(user.email.toLowerCase().includes(this.email.toLowerCase())){
                    this.filterView.push(user)
                }
            })
        },
        agentFilter(){
            this.filterView = []
            this.users.forEach(user => {
                if(user.agent.toLowerCase().includes(this.agent.toLowerCase())){
                    this.filterView.push(user)
                }
            })
        },
        resetFilter(){
            this.agency = ''
            this.email = ''
            this.agency = ''
            this.filterView = this.users
        }
    },
    components: {
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