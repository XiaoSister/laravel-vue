<template>
    <form class="col s12" @submit.prevent="register">
        <div class="input-field" :class="{'has-error': errors.has('name')}">
            <input
                type="text"
                v-model="name"
                v-validate="'required|min:6|max:24'"
                data-vv-as="用户名"
                class="validate"
                placeholder="用户名"
                name="name"
                autocomplete="off"
                required>
            <span
                v-show="errors.has('name')"
                :class="{'has-error': errors.has('name')}">
                {{ errors.first('name') }}
            </span>
        </div>
        <div class="input-field" :class="{'has-error': errors.has('password')}">
            <input
                type="password"
                v-model="password"
                v-validate="'required|min:6'"
                data-vv-as="密码"
                placeholder="密码"
                name="password"
                class="validate"
                autocomplete="off"
                required>
            <span
                v-show="errors.has('password')"
                :class="{'has-error': errors.has('password')}">
                {{ errors.first('password') }}
            </span>
        </div>
        <div class="input-field" :class="{'has-error': errors.has('password_confirmation')}">
            <input
                type="password"
                v-model="password_confirmation"
                v-validate="{'required': 'true', 'is': password}"
                data-vv-as="确认密码"
                placeholder="确认密码"
                name="password_confirmation"
                class="validate"
                autocomplete="off"
                required>
            <span
                v-show="errors.has('password_confirmation')"
                :class="{'has-error': errors.has('password_confirmation')}">
                {{ errors.first('password_confirmation') }}
            </span>
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

<style scoped lang="scss">
    .has-error{
        input{
            border: #e3342f solid 1px !important;
        }
        color: #e3342f;
        input[type=text].valid, input[type=text].valid{
            border-bottom: 1px solid #e3342f;
            box-shadow: 0 1px 0 0 #e3342f;
        }
    }
</style>
