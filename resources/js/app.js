import './bootstrap';
import {createApp} from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router'
import '../css/tailwind.css'
import OnboardingPortal from './views/OnboardingPortal.vue'
import AdminLogin from './views/AdminLogin.vue'
import AdminDashboard from './views/AdminDashboard.vue'
import AdminSubAgent from './views/AdminSubAgent.vue'
import OnboardingAgents from './views/OnboardingAgents.vue'
import OnboardingDocuments from './views/AdminDocuments.vue'
import AppointedAgents from './views/AdminAppointed.vue'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            component: OnboardingPortal
        },
        {
            path: '/admin',
            name: 'AdminLogin',
            component: AdminLogin
        },
        {
            path: '/admin/dashboard/:adminID',
            name: 'AdminDashboard',
            component: AdminDashboard,
            props: true
        },
        {
            path: '/admin/dashboard/:adminID/user/:userID/:rocketID',
            name: 'Subagent',
            component: AdminSubAgent,
            props: true
        },
        {
            path: '/admin/onboarding-agents/:adminID',
            name: 'OnboardingAgents',
            component: OnboardingAgents,
            props: true
        },
        {
            path: '/admin/onboarding-documents/:adminID',
            name: 'OnboardingDocuments',
            component: OnboardingDocuments,
            props: true
        },
        {
            path: '/admin/appointed-agents/:adminID',
            name: 'AppointedAgents',
            component: AppointedAgents,
            props: true
        }
    ],
})

createApp(App).use(router).mount("#app")