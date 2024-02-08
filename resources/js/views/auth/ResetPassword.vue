<template>
    <div class="">
        <div class="mb-3 text-start">
            <p>{{ $t('view.resetPassword.creteNewPass') }}</p>
        </div>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.user.email.$errors.length }">
                <input @blur="v$.user.email.$touch" v-model.trim="user.email" type="email"
                       :placeholder="$t('view.resetPassword.email')"
                       class="form-control form-control-lg" id="email">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.user.email.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
        </div>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.user.password.$errors.length }">
                <input @blur="v$.user.password.$touch" type="password" v-model.trim="user.password"
                       :placeholder="$t('view.resetPassword.newPass')"
                       class="form-control form-control-lg" id="password">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.user.password.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
        </div>

        <div class="form-outline mb-4">
            <div :class="{ error: v$.user.password_confirmation.$errors.length }">
                <input @blur="v$.user.password_confirmation.$touch" type="password"
                       v-model.trim="user.password_confirmation"
                       :placeholder="$t('view.resetPassword.confirmPass')"
                       class="form-control form-control-lg" id="confirmPassword">
                <div class="input-errors my-2 text-danger small text-start"
                     v-for="error of v$.user.password_confirmation.$errors" :key="error.$uid">
                    <div class="error-msg">{{ error.$message }}</div>
                </div>
            </div>
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
            <button class="btn btn-primary btn-lg bg-gradient" @click.prevent="resetPassword"
                    type="submit">{{ $t('view.resetPassword.create') }}
            </button>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from "@vuelidate/core";
import {maxLength, minLength, required, sameAs, email} from "@vuelidate/validators";
import {useToast} from "vue-toastification";
import axios from "axios";

export default {
    name: "ResetPassword",

    setup() {
        return {
            v$: useVuelidate(),
            t$: useToast(),
        }
    },

    data() {
        return {
            user: {
                email: null,
                password: null,
                password_confirmation: null,
                token: this.$route.params.hash,
            },
        }
    },

    validations() {
        return {
            user: {
                email: {required, email, minLength: minLength(6), maxLength: maxLength(32), $lazy: true},
                password: {required, minLength: minLength(8), maxLength: maxLength(64), $lazy: true},
                password_confirmation: {
                    required,
                    minLength: minLength(8),
                    sameAs: sameAs(this.user.password),
                    maxLength: maxLength(64),
                    $lazy: true
                },
            },
        }
    },

    methods: {
        async resetPassword() {
            this.v$.$validate()
            if (!this.v$.$error) {
                this.$store.dispatch('auth/resetPassword', this.user);
            }
        },
    }
}
</script>

<style scoped>

</style>
