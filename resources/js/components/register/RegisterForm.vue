<template>
    <form class="col s12" @submit.prevent="register">
        <div class="input-field">
            <input
                type="text"
                v-model="name"
                class="validate"
                placeholder="用户名"
                name="name"
                required>
        </div>
        <div class="input-field">
            <input
                type="password"
                v-model="password"
                placeholder="密码"
                name="password"
                class="validate"
                required>
        </div>
        <div class="input-field">
            <input
                type="password"
                v-model="password_confirmation"
                placeholder="确认密码"
                name="password_confirmation"
                class="validate"
                required>
        </div>
        <button type="submit" class="button-default">注册</button>
    </form>
</template>

<script>
    export default {
        name: "RegisterForm",
        data () {
            return {
                name: '',
                password: '',
                password_confirmation: '',
            }
        },
        methods:{
            register () {
                let formData = {
                    name: this.name,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                };
                axios.post('/api/register', formData).then(response => {
                    this.$router.push({name: 'index'});
                })
            }
        }
    }
</script>

<style scoped>

</style>
