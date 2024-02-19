<template>
    <div class="">
        <h3 class="h5 mt-5 mb-3 fw-bold">{{ $t('component.signIn.signIn') }}</h3>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.user.email.$errors.length }">
                <input @blur="v$.user.email.$touch" v-model.trim="user.email" type="email"
                       :placeholder="$t('component.signIn.email')" class="form-control form-control-lg"
                       id="email">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.user.email.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
        </div>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.user.password.$errors.length }">
                <input @blur="v$.user.password.$touch" type="password" v-model.trim="user.password"
                       :placeholder="$t('component.signIn.password')"
                       class="form-control form-control-lg" id="password">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.user.password.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
        </div>

        <!-- Checkbox -->
        <div class="form-check d-flex justify-content-start mb-4">
            <input v-model="user.remember" class="form-check-input" type="checkbox" value="" id="rememberMe"/>
            <label class="form-check-label mx-3" for="rememberMe"> Remember me </label>
        </div>


        <div class="form-text mb-3">
            <p class="small">
                <router-link :to="{name:'auth.signUp'}">{{
                        $t('component.signIn.signUp')
                    }}
                </router-link>
                for create new account.
                {{ $t('component.signIn.forgotYouPass') }}
                <router-link :to="{name:'auth.password.forgot'}">Create new!</router-link>
            </p>
        </div>


        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg bg-gradient" @click.prevent="signIn" type="submit">
                {{ $t('component.signIn.signIn') }}
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
import {required, email, minLength, maxLength} from '@vuelidate/validators'
import {useToast} from "vue-toastification";
import axios from 'axios';

export default {
    name: "SignIn",

    setup() {
        return {
            v$: useVuelidate(),
            t$: useToast(),
        }
    },

    created() {
        this.checkUserInState()
    },


    data() {
        return {
            user: {
                email: null,
                password: null,
                remember: false,
            },
        }
    },

    validations() {
        return {
            user: {
                email: {required, email, minLength: minLength(8), $lazy: true},
                password: {required, minLength: minLength(8), maxLength: maxLength(32), $lazy: true},
            },

        }
    },

    methods: {
        signIn() {
            this.v$.$validate();
            if (!this.v$.$error) {
                this.$store.dispatch('auth/login', this.user)
            }
        },

        checkUserInState(){
            this.$store.dispatch('auth/setLoggedInstate', this.user);
        },

        redirectToSocial(provider){
            this.$store.dispatch('auth/redirectToSocial', provider);
        },
    }
}
</script>

<style scoped>

</style>
