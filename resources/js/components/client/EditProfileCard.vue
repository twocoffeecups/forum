<template>
    <div class="card rounded-0 mb-4">
        <div class="card-header">
            Account Details
        </div>
        <div class="card-body">
            <form>
                <!-- Form Group (username)-->
                <div class="mb-3">
                    <label class="small mb-1" for="login">{{ $t('component.signUp.login') }} (how your name will appear
                        to other users on the site)</label>
                    <div v-if="userDetails" :class="{ error: v$.userDetails.login.$errors.length }">
                        <div class="d-flex">
                            <input @blur="v$.userDetails.login.$touch" v-model.trim="userDetails.login" type="text"
                                   class="form-control form-control-lg" id="login">
                            <div class="d-flex my-auto">
                               <span @click="updateProfile('login', userDetails.login)" :title="$t('view.editAccount.save')" role="button" class="p-2" style="font-size: 1.4em">
                                    <i class="fas fa-save text-primary"></i>
                                </span>
                            </div>

                        </div>
                        <div class="input-errors my-2 text-danger small text-start"
                             v-for="error of v$.userDetails.login.$errors" :key="error.$uid">
                            <div class="error-msg">{{ error.$message }}</div>
                        </div>

                    </div>
                </div>
                <div class="mb-3">
                    <label class="small mb-1" for="name">{{ $t('component.signUp.firstName') }}</label>
                    <div v-if="userDetails" :class="{ error: v$.userDetails.name.$errors.length }">
                        <div class="d-flex">
                            <input @blur="v$.userDetails.name.$touch" v-model.trim="userDetails.name" type="text"
                                   class="form-control form-control-lg" id="name">
                            <div class="d-flex my-auto">
                               <span @click="updateProfile('name', userDetails.name)" :title="$t('view.editAccount.save')" role="button" class="p-2" style="font-size: 1.4em">
                                   <i class="fas fa-save text-primary"></i>
                               </span>
                            </div>
                        </div>
                        <div class="input-errors my-2 text-danger small text-start"
                             v-for="error of v$.userDetails.name.$errors" :key="error.$uid">
                            <div class="error-msg">{{ error.$message }}</div>
                        </div>
                    </div>
                </div>
                <!-- Form row -->
                <div class="row gx-3 mb-3">
                    <!-- Form Group (email address)-->
                    <div v-if="userDetails" class="col-md-12">
                        <label class="small mb-1" for="email">{{ $t('component.signUp.email') }}</label>
                        <div :class="{ error: v$.userDetails.email.$errors.length }">
                            <div class="d-flex">
                                <input @blur="v$.userDetails.email.$touch" v-model.trim="userDetails.email" type="email"
                                       class="form-control form-control-lg" id="email">
                                <div class="d-flex my-auto">
                                   <span @click="updateProfile('email', userDetails.email)" :title="$t('view.editAccount.save')" role="button" class="p-2" style="font-size: 1.4em">
                                       <i class="fas fa-save text-primary"></i>
                                   </span>
                                </div>
                            </div>

                            <div class="input-errors my-2 text-danger small text-start"
                                 v-for="error of v$.userDetails.email.$errors" :key="error.$uid">
                                <div class="error-msg">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, email, minLength, maxLength,} from '@vuelidate/validators'
import {useToast} from "vue-toastification";
import {mapGetters} from "vuex";

export default {
    name: "EditProfileCard",

    computed: {
        ...mapGetters({
            userDetails: 'auth/userDetails',
        }),
    },

    setup() {
        return {
            v$: useVuelidate(),
            t$: useToast(),
        }
    },

    validations() {
        return {
            userDetails: {
                login: {required, minLength: minLength(5), maxLength: maxLength(32), $lazy: true},
                email: {required, email, minLength: minLength(8), maxLength: maxLength(32), $lazy: true},
                name: {required, minLength: minLength(5), maxLength: maxLength(128), $lazy: true},
            },
        }
    },

    methods: {
        async updateProfile(key, value) {
            this.v$.$validate(key);
            if (!this.v$.$error) {
                const data = new FormData();
                data.append(key, value);
                data.append('_method', 'put')
                this.$store.dispatch('profile/updateProfile', data);
            }
        }
    }
}
</script>

<style scoped>

</style>
