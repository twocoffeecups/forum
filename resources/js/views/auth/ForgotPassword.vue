<template>
    <div class="">
        <h3 class="h5 mt-5 mb-3 fw-bold">{{ $t('component.forgotPassword.forgotPassword') }}</h3>

        <div class="mb-3 text-start">
            <label for="email" class="form-label">Enter your email to get a link to reset your
                password.</label>
        </div>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.email.$errors.length }">
                <input @blur="v$.email.$touch" v-model.trim="email" type="email"
                       :placeholder="$t('component.forgotPassword.email')"
                       class="form-control form-control-lg" id="email">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.email.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
        </div>

        <div class="form-text mb-3">
            <p class="small">
                <router-link :to="{name:'auth.signUp'}">{{
                        $t('component.forgotPassword.signUp')
                    }}
                </router-link>
                {{ $t('component.forgotPassword.createNewAcc') }}
                Have account?
                <router-link :to="{name:'auth.signIn'}">{{
                        $t('component.forgotPassword.signIn')
                    }}
                </router-link>
            </p>
        </div>


        <div class="d-grid gap-2">
            <button class="btn btn-primary btn-lg bg-gradient" @click.prevent="forgotPassword"
                    type="submit">{{ $t('component.forgotPassword.forgot') }}
            </button>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, email, minLength, maxLength} from '@vuelidate/validators'
import {useToast} from "vue-toastification";
import axios from "axios";

export default {
    name: "ForgotPassword",

    setup() {
        return {
            v$: useVuelidate(),
            t$: useToast(),
        }
    },

    data() {
        return {
            email: null,
        }
    },

    validations() {
        return {
            email: {required, email, minLength: minLength(8), maxLength: maxLength(32), $lazy: true},
        }
    },

    methods: {

        forgotPassword() {
            this.v$.$validate();
            if (!this.v$.$error) {
                this.$store.dispatch('auth/forgotPassword', this.email);
            }
        }

    },
}
</script>

<style scoped>

</style>
