<template>
    <div class="container mt-5 mx-auto">
        <h2>Password Reset</h2>
        <div class="row">
            <div class="px-lg-5 py-lg-5">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <div :class="{ error: v$.email.$errors.length }">
                        <input @blur="v$.email.$touch" v-model.trim="email" type="email" class="form-control" id="email" aria-describedby="emailFeedback" required>
                        <div class="input-errors text-danger" v-for="error of v$.email.$errors" :key="error.$uid">
                            <div class="error-msg">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="login-form-password" class="form-label">Password</label>
                    <div :class="{ error: v$.password.$errors.length }">
                        <input @blur="v$.password.$touch" type="password" v-model.trim="password" class="form-control" id="login-form-password">
                        <div class="input-errors text-danger" v-for="error of v$.password.$errors" :key="error.$uid">
                            <div class="error-msg">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="confirmPass">Confirm password</label>
                    <div :class="{ error: v$.confirmPass.$errors.length }">
                        <input @blur="v$.confirmPass.$touch" v-model.trim="confirmPass" type="password" class="form-control" id="confirmPass" aria-describedby="passwordFeedback" required>
                        <div class="input-errors text-danger" v-for="error of v$.confirmPass.$errors" :key="error.$uid">
                            <div class="error-msg">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="form-text"><a href="#" >Sign up</a> for create new account.</div>

                    <div class="form-text">Have account? <a href="#">Sign in!</a></div>
                </div>

                <div class="text-center">
                    <button @click.prevent="signIn" type="button" class="btn bg-info btn-lg my-4">Sign in</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import {required, email, minLength, maxLength, sameAs} from '@vuelidate/validators'
import axios from 'axios';
export default {
    name: "PasswordReset",

    setup(){
        return{
            v$: useVuelidate(),
        }
    },

    data(){
        return{
            email: null,
            password: null,
            confirmPass: null,
        }
    },

    validations(){
        return{
            email: {required, email, minLength:minLength(8), $lazy: true},
            password: {required, minLength:minLength(8), maxLength:maxLength(32), $lazy: true},
            confirmPass: {required, minLength:minLength(6), sameAs: sameAs(this.password), maxLength:maxLength(32), $lazy: true},
        }
    },

    methods:{
        async signIn(){
            this.v$.$validate()
            if(!this.v$.$error){
                console.log('email: ', this.email);
                console.log('new password: ', this.password);
                console.log('password confirmation: ', this.confirmPass);
                console.log('hash: ', this.$route.params.hash);

                // await axios.post('/api/auth/password/reset', {
                //     email: this.email,
                //     password: this.password,
                //     passwordConfirmation: this.confirmPass,
                //     token: this.$route.params.hash,
                // })
                //     .then(res => {
                //         console.log(res);
                //     })
                //     .catch(error => {
                //         console.log(error);
                //     })
            }
        }
    }


}
</script>

<style scoped>

</style>
