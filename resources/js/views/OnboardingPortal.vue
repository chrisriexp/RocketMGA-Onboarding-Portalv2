<template>
    <!--Background Image-->
    <div class="w-full bottom-0 fixed z-0">
        <img src="../assets/1.jpg" alt="Abstract Background Image">
    </div>

    <Header class="z-10 relative" />

    <Login v-if="!loggedIn" @userLoggedIn="updateLogin" class="z-10 mx-auto relative mt-48" />
    <Form v-else :userID="userID" class="z-10 mx-auto relative" />

    <Footer class="z-10 bottom-0 fixed" />
</template>

<script>
import loading from '../components/loading.vue'
import Login from '../components/onboardingLogin.vue'
import Form from '../components/onboardingForm.vue'
import Header from '../components/header.vue'
import Footer from '../components/footer.vue'

export default {
    name: "OnboardingPortal",
    data () {
        return {
            loggedIn: false, 
            userID: ''
        }
    },
    methods: {
        updateLogin(userID) {
            this.loggedIn = true
            this.userID = userID
        }
    },
    components: {
        loading,
        Login,
        Form,
        Header,
        Footer
    }
}
</script>

<style>

</style>