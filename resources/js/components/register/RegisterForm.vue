<template>
    <form class="col s12" @submit.prevent="register">
        <div class="input-field" :class="{'has-error': errors.has('name')}">
            <input
                type="text"
                v-model="name"
                v-validate="'required|min:4|max:24'"
                data-vv-as="用户名"
                class="validate"
                placeholder="用户名"
                name="name"
                autocomplete="off"
                autofocus
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
        <div class="input-field">
            <input
                type="text"
                v-validate="{'required': 'true'}"
                data-vv-as="验证码"
                placeholder="验证码"
                name="captcha_code"
                v-model="captcha_code"
                class="validate"
                autocomplete="off"
                required>
            <img :src="captcha_image" alt="" @click="getCaptchas">
            <span
                v-show="errors.has('captcha_code')"
                :class="{'has-error': errors.has('captcha_code')}">
                {{ errors.first('captcha_code') }}
            </span>
        </div>
        <input
            type="text"
            name="captcha_key"
            v-model="captcha_key"
            hidden>
        <button type="submit" class="button-default">注册</button>
    </form>
</template>

<script>
    export default {
        name: "RegisterForm",
        mounted () {
            this.getCaptchas ()
        },
        data () {
            return {
                name: '',
                password: '',
                password_confirmation: '',
                captcha_key: '',
                captcha_code: '',
                captcha_image: '',
            }
        },
        methods:{
            register () {
                let formData = {
                    name: this.name,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                    captcha_key: this.captcha_key,
                    captcha_code: this.captcha_code,
                };
                axios.post('/api/register', formData).then(response => {
                    if (response.data.status === 200) {
                        this.$router.push({name: 'index'});
                    }else{
                        console.log(response.data);
                    }

                })
            },
            getCaptchas () {
                axios.get('/api/captchas').then(response => {
                    this.captcha_image = response.data.data.captcha_image;
                    this.captcha_key = response.data.data.captcha_key;
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
