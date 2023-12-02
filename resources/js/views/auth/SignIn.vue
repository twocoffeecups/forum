<template>

    <!-- Sign in form -->
    <div class="container py-5 mx-auto my-auto">
        <div class="row d-flex justify-content-center align-items-center">

            <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-auto">

                <div class="card shadow-2-strong bg-gradient" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="logo">
                            <img src="../../assets/img/logo.png" class="img-fluid" alt="Bootstrap" width="200">
                        </div>

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
                            <input class="form-check-input" type="checkbox" value="" id="rememberPass"/>
                            <label class="form-check-label mx-3" for="rememberPass"> Remember password </label>
                        </div>


                        <div class="form-text mb-3">
                            <p class="small">
                                <router-link :to="{name:'auth.signUp'}">{{
                                        $t('component.signIn.signUp')
                                    }}
                                </router-link>
                                for create new account.
                                {{ $t('component.signIn.forgotYouPass') }}
                                <router-link :to="{name:'auth.forgotPassword'}">Create new!</router-link>
                            </p>
                        </div>


                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-lg bg-gradient" @click.prevent="signIn" type="submit">
                                {{ $t('component.signIn.signIn') }}
                            </button>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid gap-2">
                            <button class="btn btn-lg border-0 btn-block btn-primary mb-2 bg-gradient"
                                    style="background-color: #dd4b39;"
                                    type="submit"><i class="fab fa-yandex-international me-2"></i>Sign in with Yandex
                            </button>

                            <button class="btn btn-lg border-0 btn-block btn-primary bg-gradient"
                                    style="background-color:  #3b5998;"
                                    type="submit"><i class="fab fa-google me-2"></i> Sign in with google
                            </button>
                        </div>

                    </div>
                </div>
            </div>
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
                this.$store.dispatch('login', this.user)
            }
        },

        checkUserInState(){
            this.$store.dispatch('setLoggedInstate', this.user);
        },

    }
}
</script>

<style scoped>

</style>
