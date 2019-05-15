<template>
    <div class="pages section">
        <div class="container">
            <div class="pages-head">
                <h3>注册</h3>
            </div>
            <div class="register">
                <div class="row">
                    <register-form></register-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import RegisterForm from './RegisterForm'
    export default {
        name: "Register",
        components:{
            RegisterForm
        }
    }
</script>

<style scoped>

</style>
