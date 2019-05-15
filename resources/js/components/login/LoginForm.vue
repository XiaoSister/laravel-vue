<template>
    <form class="col s12"  @submit.prevent="login">
        <div class="input-field" :class="{'has-error': errors.has('name')}">
            <input
                type="text"
                class="validate"
                name="name"
                v-model="name"
                v-validate="'required|min:4|max:24'"
                data-vv-as="用户名"
                placeholder="用户名"
                autofocus
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
        <a href=""><h6>忘记密码</h6></a>
        <button type="submit" class="button-default">登陆</button>
    </form>
</template>

<script>
    import md5 from 'js-md5'
    import JWTToken from '../../helpers/jwt'
    export default {
        name: "LoginForm",
        mounted () {
            this.getCaptchas ()
        },
        data () {
            return {
                name: '',
                password: '',
                captcha_key: '',
                captcha_code: '',
                captcha_image: '',
            }
        },
        methods:{
            getCaptchas () {
                axios.get('/api/captchas').then(response => {
                    this.captcha_image = response.data.data.captcha_image;
                    this.captcha_key = response.data.data.captcha_key;
                })
            },
            login () {
                let formData = {
                    name: this.name,
                    password: md5(this.password),
                    captcha_key: this.captcha_key,
                    captcha_code: this.captcha_code,
                };
                axios.post('/api/login', formData).then(response => {
                    // JWTToken.setToken(response.data.token);
                    console.log(response.data);
                    // if (response.data.status === 200) {
                    //     this.$router.push({name: 'index'});
                    // }else{
                    //     console.log(response.data);
                    // }

                })
            }
        }
    }
</script>

<style scoped>

</style>
