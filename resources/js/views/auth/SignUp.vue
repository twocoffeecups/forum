<template>
    <div class="">
        <h3 class="h5 mt-5 mb-3 fw-bold">{{ $t('component.signUp.signUp') }}</h3>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.signUpForm.login.$errors.length }">
                <input @blur="v$.signUpForm.login.$touch" v-model.trim="signUpForm.login" type="text"
                       :placeholder="$t('component.signUp.login')" class="form-control form-control-lg"
                       id="login">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.signUpForm.login.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
        </div>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.signUpForm.name.$errors.length }">
                <input @blur="v$.signUpForm.name.$touch" v-model.trim="signUpForm.name"
                       type="text" :placeholder="$t('component.signUp.firstName')"
                       class="form-control form-control-lg" id="firstName">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.signUpForm.name.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
        </div>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.signUpForm.email.$errors.length }">
                <input @blur="v$.signUpForm.email.$touch" v-model.trim="signUpForm.email" type="email"
                       :placeholder="$t('component.signUp.email')" class="form-control form-control-lg"
                       id="email">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.signUpForm.email.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
        </div>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.signUpForm.password.$errors.length }">
                <input @blur="v$.signUpForm.password.$touch" v-model.trim="signUpForm.password"
                       type="password" :placeholder="$t('component.signUp.password')"
                       class="form-control form-control-lg" id="password">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.signUpForm.password.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
        </div>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.signUpForm.password_confirmation.$errors.length }">
                <input @blur="v$.signUpForm.password_confirmation.$touch"
                       v-model.trim="signUpForm.password_confirmation" type="password"
                       :placeholder="$t('component.signUp.confirmPass')"
                       class="form-control form-control-lg" id="confirmPassword">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.signUpForm.password_confirmation.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
        </div>


        <div class="form-text mb-3">
            <p class="small">Have account?
                <router-link :to="{name:'auth.signIn'}">{{
                        $t('component.signIn.signIn')
                    }}
                </router-link>
                .
                {{ $t('component.signIn.forgotYouPass') }}
                <router-link :to="{name:'auth.password.forgot'}">Create new!</router-link>
            </p>
        </div>


        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg bg-gradient" @click.prevent="signUp" type="submit">
                {{ $t('component.signUp.signUp') }}
            </button>
        </div>

        <hr class="my-4">

        <div class="d-grid gap-2">
            <button @click.prevent="redirectToSocial('yandex')" class="btn btn-lg border-0 btn-block btn-primary mb-2 bg-gradient"
                    style="background-color: #dd4b39;"
                    type="submit"><i class="fab fa-yandex-international me-2"></i>Sign in with Yandex
            </button>

            <button @click.prevent="redirectToSocial('google')" class="btn btn-lg border-0 btn-block btn-primary bg-gradient"
                    style="background-color:  #3b5998;"
                    type="submit"><i class="fab fa-google me-2"></i> Sign in with google
            </button>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, email, minLength, maxLength, sameAs,} from '@vuelidate/validators'
import {useToast} from "vue-toastification";
import axios from "axios";

export default {
    name: "SignUp",

    setup() {
        return {
            v$: useVuelidate(),
            t$: useToast(),
        }
    },


    data() {
        return {
            signUpForm: {
                login: null,
                email: null,
                name: null,
                password: null,
                password_confirmation: null,
            },
        }
    },

    validations() {
        return {
            signUpForm: {
                login: {required, minLength: minLength(5), maxLength: maxLength(32), $lazy: true},
                email: {required, email, minLength: minLength(8), maxLength: maxLength(32), $lazy: true},
                name: {required, minLength: minLength(5), maxLength: maxLength(128), $lazy: true},
                password: {required, minLength: minLength(8), maxLength: maxLength(32), $lazy: true},
                password_confirmation: {
                    required,
                    minLength: minLength(6),
                    sameAs: sameAs(this.signUpForm.password),
                    maxLength: maxLength(32),
                    $lazy: true
                },
            },
        }
    },

    methods: {
        signUp() {
            this.v$.$validate();
            if (!this.v$.$error) {
                let data = new FormData();
                for (let [key, value] of Object.entries(this.signUpForm)) {
                    data.append(key, value);
                }
                console.log(data);
                this.$store.dispatch('auth/register', data);
            }
        },

        redirectToSocial(provider){
            this.$store.dispatch('auth/redirectToSocial', provider);
        },
    }
}
</script>

<style scoped>

</style>
