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
import api from "../../api/api";
import {useToast} from "vue-toastification";

export default {
    name: "CreateUserModal",

    setup() {
        return {
            v$: useVuelidate(),
            t$: useToast(),
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
            roles: [],
            selectedRole: null,
        }
    },

    validations() {
        return {
            registrationForm: {
                login: {required, minLength: minLength(5), maxLength: maxLength(32)},
                firstName: {minLength:minLength(2), maxLength:maxLength(64)},
                lastName: {minLength:minLength(2), maxLength:maxLength(64)},
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
                api.post('/api/admin/user/register', data)
                    .then(res => {
                        console.log(res);
                        this.t$.success(res.data.message)
                    })
                    .catch(error => {
                        this.t$.error(error.response.data.message ?? "Error!");
                        console.log(error);
                    })
            }
        },

        getRoles() {
            api.get('/api/admin/role')
                .then(res => {
                    console.log(res);
                    this.roles = res.data.roles;
                })
        },
    }
}
</script>

<style scoped>

</style>
