<template>
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#create-user-modal">+ CRETE USER
        </button>
    </div>

    <div class="modal fade" id="create-user-modal" tabindex="-1" aria-labelledby="create-user-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Create user</h1>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <div :class="{ error: v$.registrationForm.login.$errors.length }">
                            <label for="login" class="col-form-label">Login:</label>
                            <input @blur="v$.registrationForm.login.$touch" type="text" v-model="registrationForm.login"
                                   class="form-control" id="login">
                            <div class="input-errors" v-for="error of v$.registrationForm.login.$errors"
                                 :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div :class="{ error: v$.registrationForm.firstName.$errors.length }">
                            <label for="firstName" class="col-form-label">First name:</label>
                            <input @blur="v$.registrationForm.firstName.$touch" type="text" v-model="registrationForm.firstName"
                                   class="form-control" id="firstName">
                            <div class="input-errors" v-for="error of v$.registrationForm.firstName.$errors"
                                 :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div :class="{ error: v$.registrationForm.lastName.$errors.length }">
                            <label for="lastName" class="col-form-label">Last name:</label>
                            <input @blur="v$.registrationForm.lastName.$touch" type="text" v-model="registrationForm.lastName"
                                   class="form-control" id="lastName">
                            <div class="input-errors" v-for="error of v$.registrationForm.lastName.$errors"
                                 :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="col-form-label">Role</label>
                        <select @change="selectedRole = $event.target.value" id="role" class="form-control">
                            <option v-for="role in roles" :value="role.id">{{ role.name }}</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <div :class="{ error: v$.registrationForm.email.$errors.length }">
                            <label for="login" class="col-form-label">Email:</label>
                            <input @blur="v$.registrationForm.email.$touch" type="email"
                                   v-model="registrationForm.email" class="form-control" id="email">
                            <div class="input-errors" v-for="error of v$.registrationForm.email.$errors"
                                 :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click="createUser" type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, minLength, maxLength, email, sameAs} from '@vuelidate/validators'
import {mapGetters} from "vuex";

export default {
    name: "CreateUserModal",

    computed: {
        ...mapGetters({
            roles: 'adminUsers/getRoles',
        }),
    },

    setup() {
        return {
            v$: useVuelidate(),
        }
    },

    mounted() {
        this.getRoles();
    },

    data() {
        return {
            registrationForm: {
                login: null,
                firstName: null,
                lastName: null,
                email: null,
            },
            selectedRole: null,
        }
    },

    validations() {
        return {
            registrationForm: {
                login: {required, minLength: minLength(5), maxLength: maxLength(32)},
                firstName: {required, minLength:minLength(2), maxLength:maxLength(64)},
                lastName: {required, minLength:minLength(2), maxLength:maxLength(64)},
                email: {required, email, minLength: minLength(7), maxLength: maxLength(32)},
            },
        }
    },

    methods: {
        createUser() {
            this.v$.$validate();
            if (!this.v$.$error) {
                let data = new FormData();
                for (let [key, value] of Object.entries(this.registrationForm)) {
                    data.append(key, value)
                }
                data.append('roleId', this.selectedRole);
                this.$store.dispatch('adminUsers/createUser', data);
            }
        },

        getRoles() {
            this.$store.dispatch('adminUsers/getRoles');
        },
    }
}
</script>

<style scoped>

</style>
