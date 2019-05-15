<template>
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>登陆</h3>
            </div>
            <div class="login">
                <div class="row">
                    <login-form></login-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LoginForm from './LoginForm'
    export default {
        name: "Login",
        components:{
            LoginForm
        }
    }
</script>

<style scoped>

</style>
