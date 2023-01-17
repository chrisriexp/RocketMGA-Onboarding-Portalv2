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
                <div class="flex gap-4 bg-custom-red py-2 px-6 rounded-xl hover:cursor-pointer">
                    <HomeIcon class="h-6 w-6 text-white" /> 
                    <p class="text-md text-white font-semibold">Dashboard</p>
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
                <div class="grid gap-4">
                    <h1 class="text-3xl text-custom-gray">Welcome back!</h1>
                    <p class="text-custom-gray opacity-50">Here is some important information for you:</p>
                </div>

                <!--Notification and Analytics Section-->
                <div class="grid grid-cols-3 gap-24 w-full">
                    <!--Notifications-->
                    <div class="grid col-span-2 bg-white w-full rounded-xl p-6 gap-4 h-fit">
                        <div class="flex h-fit w-full flow-root">
                            <h2 class="text-custom-gray float-left text-xl font-bold">Latest Notifications</h2>

                            <p class="text-sm float-right text-custom-red my-auto font-semibold flex gap-2 mt-2">View All <ArrowRightCircleIcon class="w-4 h-4 text-custom-red text-semibold my-auto" /></p>
                        </div>

                        <div @click="notificationAgent(notification.id, notification.agency_id)" v-for="(notification, index) in notifications" :key="index" class="flex w-full h-fit bg-[#f3f6f9] py-4 px-6 rounded-xl gap-4 hover:cursor-pointer">
                            <div v-if="!notification.read" class="w-[8px] h-[8px] bg-custom-red rounded-[50%] my-auto"></div>
                            <div v-else class="w-[8px] h-[8px] rounded-[50%] my-auto"></div>
                            <p class="text-custom-gray text-sm font-semibold"> <span class="text-custom-red">{{ notification.name }}</span> has completed their onboarding application!</p>
                        </div>
                    </div>

                    <!--Analytics-->
                    <div class="grid col bg-white w-full rounded-xl p-6">
                        <div class="grid h-fit w-full gap-6">
                            <h2 class="text-custom-gray float-left text-xl font-bold">Analytics</h2>

                            <div class="flex flow-root gap-4 w-full border-b-2 border-custom-gray border-opacity-30 h-fit p-4">
                                <div class="flex float-left gap-4 my-auto">
                                    <UserCircleIcon class="h-[20px] w-[20px] text-custom-gray my-auto" />
                                    <p class="text-custom-gray text-sm my-atuo">Agents Started</p>
                                </div>
                                <p class="my-auto text-custom-gray font-medium text-lg float-right">{{ users.length }}</p>
                            </div>

                            <div class="flex flow-root gap-4 w-full border-b-2 border-custom-gray border-opacity-30 h-fit p-4">
                                <div class="flex float-left gap-4 my-auto">
                                    <CheckBadgeIcon class="h-[20px] w-[20px] text-custom-gray my-auto" />
                                    <p class="text-custom-gray text-sm my-atuo">Completed</p>
                                </div>
                                <p class="my-auto text-custom-gray font-medium text-lg float-right">{{ completedUsers.length }}</p>
                            </div>

                            <div class="flex flow-root gap-4 w-full border-b-2 border-custom-gray border-opacity-30 h-fit p-4">
                                <div class="flex float-left gap-4 my-auto">
                                    <ReceiptPercentIcon class="h-[20px] w-[20px] text-custom-gray my-auto" />
                                    <p class="text-custom-gray text-sm my-atuo">Conversion %</p>
                                </div>
                                <p class="my-auto text-custom-gray font-medium text-lg float-right">{{ conversion }}%</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Agent Progress-->
                <div class="grid bg-white w-full rounded-xl p-6 gap-2">
                    <div class="flex h-fit w-full flow-root">
                        <h2 class="text-custom-gray float-left text-xl font-bold">Agent Progress</h2>

                        <p @click="gotoOnboardingAgents()" class="text-sm float-right text-custom-red my-auto font-semibold flex gap-2 mt-2 hover:cursor-pointer">View All <ArrowRightCircleIcon class="w-4 h-4 text-custom-red text-semibold my-auto" /></p>
                    </div>

                    <div class="grid grid-cols-4 w-full h-fit text-sm text-custom-gray font-medium opacity-50 border-b-2 py-4 px-2">
                        <p class="grid col">Agency</p>
                        <p class="grid col">Email</p>
                        <p class="grid col">Agent</p>
                        <p class="grid col">Stage</p>
                    </div>

                    <div @click="progressAgent(agent.id, agent.rocketID)" v-for="(agent, index) in progress" :key="index" class="grid grid-cols-4 w-full h-fit p-2 rounded-xl text-sm text-custom-gray font-semibold hover:cursor-pointer hover:bg-custom-gray hover:bg-opacity-5">
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
</template>

<script>
import moment from 'moment';
import {UserCircleIcon, HomeIcon, DocumentTextIcon, ArrowLeftOnRectangleIcon, ArrowRightCircleIcon, CheckBadgeIcon, ReceiptPercentIcon} from '@heroicons/vue/24/outline'

export default {
    name: 'Admin Dashboard',
    data () {
        return {
            users: [],
            completedUsers: [],
            date: '',
            notifications: [],
            conversion: '',
            progress: []
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
                this.users.push({id: user.id, rocketID: user.rocketMGA_id, agency: user.agency_name, agent: user.agent_name, stage: user.stage, submitted: user.submitted})
                
                if(user.submitted){
                    this.completedUsers.push({id: user.id, rocketID: user.rocketMGA_id, agency: user.agency_name, agent: user.agent_name, stage: user.stage, submitted: user.submitted})
                }
            })

            response.data.slice(0, 4).forEach(user => {
                this.progress.push({id: user.id, rocketID: user.rocketMGA_id, agency: user.agency_name, agent: user.agent_name, email: user.email, stage: user.stage, submitted: user.submitted})
            })
        })

        this.moment = moment
        this.date = new Date()

        await axios.get('/api/notifications')
        .then(request => {
            request.data.slice(0, 4).forEach(notification => {
                this.notifications.push({name: notification.agency, agency_id: notification.agency_id, id: notification.id, date: notification.created_at, read: notification.read})
            })
        })

        this.conversion = this.completedUsers.length / this.users.length * 100

    },
    methods: {
        async logout() {
            await axios.get('/api/admin/logout/' + this.adminID)
            window.location.reload();
        },
        async allUsers() {
            this.users = []
            await axios.get('/api/users')
            .then(response => {
                response.data.forEach(user => {
                    this.users.push({id: user.id, rocketID: user.rocketMGA_id, agency: user.agency_name, agent: user.agent_name, stage: user.stage, submitted: user.submitted})
                })
            })
        },
        async submittedUsers() {
            this.users = []
            await axios.get('/api/users')
            .then(response => {
                response.data.forEach(user => {
                    if(user.submitted){
                        this.users.push({id: user.id, rocketID: user.rocketMGA_id, agency: user.agency_name, agent: user.agent_name, stage: user.stage, submitted: user.submitted})
                    }
                    return
                })
            })
        },
        async notificationAgent(id, agency_id) {
            await axios.get('/api/notification/read/' + id)

            let rmga_id = ''
            await axios.get('/api/user/' + agency_id)
            .then(response => {
                rmga_id = response.data.rocketMGA_id
            })

            this.$router.push({name: 'Subagent', params: {adminID: this.adminID, userID: agency_id, rocketID: rmga_id}})
        },
        progressAgent(id, rocketID){
            this.$router.push({name: 'Subagent', params: {adminID: this.adminID, userID: id, rocketID: rocketID}})
        },
        gotoOnboardingAgents(){
            this.$router.push({name: 'OnboardingAgents', params: {adminID: this.adminID}})
        },
        gotoOnboardingDocuments(){
            this.$router.push({name: 'OnboardingDocuments', params: {adminID: this.adminID}})
        },
        gotoAppointedAgents(){
            this.$router.push({name: 'AppointedAgents', params: {adminID: this.adminID}})
        }

    },
    components: {
        UserCircleIcon,
        HomeIcon,
        DocumentTextIcon,
        ArrowLeftOnRectangleIcon,
        ArrowRightCircleIcon,
        CheckBadgeIcon,
        ReceiptPercentIcon
    }
}
</script>