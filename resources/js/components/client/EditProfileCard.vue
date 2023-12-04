<template>
    <div class="card mb-4">
        <div class="card-header">
            Account Details
        </div>
        <div class="card-body">
            <form>
                <!-- Form Group (username)-->
                <div class="mb-3">
                    <label class="small mb-1" for="login">{{ $t('component.signUp.login') }} (how your name will appear
                        to other users on the site)</label>
                    <div :class="{ error: v$.user.login.$errors.length }">
                        <input @blur="v$.user.login.$touch" v-model.trim="user.login" type="text"
                               class="form-control form-control-lg" id="login">
                        <div class="input-errors my-2 text-danger small text-start"
                             v-for="error of v$.user.login.$errors" :key="error.$uid">
                            <div class="error-msg">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>
                <!-- Form Row-->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (first name)-->
                    <div class="col-md-6">
                        <label class="small mb-1" for="firstName">{{ $t('component.signUp.firstName') }}</label>
                        <div :class="{ error: v$.user.firstName.$errors.length }">
                            <input @blur="v$.user.firstName.$touch" v-model.trim="user.firstName" type="text"
                                   class="form-control form-control-lg" id="firstName">
                            <div class="input-errors my-2 text-danger small text-start"
                                 v-for="error of v$.user.firstName.$errors" :key="error.$uid">
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Form Group (last name)-->
                    <div class="col-md-6">
                        <label class="small mb-1" for="lastName">{{ $t('component.signUp.lastName') }}</label>
                        <div :class="{ error: v$.user.lastName.$errors.length }">
                            <input @blur="v$.user.lastName.$touch" v-model.trim="user.lastName" type="text"
                                   class="form-control form-control-lg" id="lastName">
                            <div class="input-errors my-2 text-danger small text-start"
                                 v-for="error of v$.user.lastName.$errors" :key="error.$uid">
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Form row -->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (email address)-->
                    <div class="col-md-6">
                        <label class="small mb-1" for="email">{{ $t('component.signUp.email') }}</label>
                        <div :class="{ error: v$.user.email.$errors.length }">
                            <input @blur="v$.user.email.$touch" v-model.trim="user.email" type="email"
                                   class="form-control form-control-lg" id="email">
                            <div class="input-errors my-2 text-danger small text-start"
                                 v-for="error of v$.user.email.$errors" :key="error.$uid">
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>
                    <!-- Form Group (phone number)-->
                    <div class="col-md-6">
                        <label class="small mb-1" for="phone">{{ $t('component.signUp.phone') }}</label>
                        <div :class="{ error: v$.user.phone.$errors.length }">
                            <input @blur="v$.user.phone.$touch" v-model.trim="user.phone" type="tel"
                                   class="form-control form-control-lg" id="phone">
                            <div class="input-errors my-2 text-danger small text-start"
                                 v-for="error of v$.user.phone.$errors" :key="error.$uid">
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Save changes button-->
                <button @click.prevent="updateProfile" class="btn btn-primary" type="button">
                    {{ $t('view.editAccount.save') }}
                </button>
            </form>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, email, minLength, maxLength,} from '@vuelidate/validators'
import {useToast} from "vue-toastification";

export default {
    name: "EditProfileCard",
    props:['userDetails'],

    setup() {
        return {
            v$: useVuelidate(),
            t$: useToast(),
        }
    },

    data() {
        return {
            user: {
                login: this.userDetails.login,
                email: this.userDetails.email,
                firstName: this.userDetails.firstName,
                lastName: this.userDetails.lastName,
                phone: this.userDetails.phone,
            },
        }
    },

    validations() {
        return {
            user: {
                login: {required, minLength: minLength(6), maxLength: maxLength(32), $lazy: true},
                email: {required, email, minLength: minLength(8), maxLength: maxLength(32), $lazy: true},
                firstName: {required, minLength: minLength(2), maxLength: maxLength(32), $lazy: true},
                lastName: {required, minLength: minLength(2), maxLength: maxLength(32), $lazy: true},
                phone: {minLength: minLength(9), maxLength: maxLength(13), $lazy: true},
            },
        }
    },

    methods: {
        async updateProfile() {
            this.v$.$validate();
            if (!this.v$.$error) {
                this.$store.dispatch('updateProfile', this.user);
            }
        }
    }
}
</script>

<style scoped>

</style>
