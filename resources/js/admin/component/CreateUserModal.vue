<template>
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#create-user-modal">+ CRETE USER</button>
    </div>

    <div class="modal fade" id="create-user-modal" tabindex="-1" aria-labelledby="create-user-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Create user</h1>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <div :class="{ error: v$.login.$errors.length }">
                            <label for="login" class="col-form-label">Login:</label>
                            <input @blur="v$.login.$touch" type="text" v-model="login" class="form-control" id="login">
                            <div class="input-errors" v-for="error of v$.login.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div :class="{ error: v$.firstName.$errors.length }">
                            <label for="firstName" class="col-form-label">First name:</label>
                            <input @blur="v$.firstName.$touch" type="text" v-model="firstName" class="form-control" id="firstName">
                            <div class="input-errors" v-for="error of v$.firstName.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div :class="{ error: v$.lastName.$errors.length }">
                            <label for="login" class="col-form-label">Last name:</label>
                            <input @blur="v$.lastName.$touch" type="text" v-model="lastName" class="form-control" id="lastName">
                            <div class="input-errors" v-for="error of v$.lastName.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="col-form-label">Role</label>
                        <select id="role" class="form-control">
                            <option value="1">User</option>
                            <option value="2">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <div :class="{ error: v$.email.$errors.length }">
                            <label for="login" class="col-form-label">Email:</label>
                            <input @blur="v$.email.$touch" type="email" v-model="email" class="form-control" id="email">
                            <div class="input-errors" v-for="error of v$.email.$errors" :key="error.$uid">
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
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, maxLength, email, sameAs } from '@vuelidate/validators'
export default {
    name: "CreateUserModal",

    setup(){
        return{
            v$: useVuelidate()
        }
    },

    data(){
        return{
            login: null,
            firstName: null,
            lastName: null,
            email: null,
            role: null,
        }
    },

    validations(){
        return{
            login: {required, minLength:minLength(5), maxLength:maxLength(32)},
            firstName: {required, minLength:minLength(5), maxLength:maxLength(64)},
            lastName: {required, minLength:minLength(5), maxLength:maxLength(64)},
            email: {required, email, minLength:minLength(7), maxLength:maxLength(32)},
        }
    },

    methods:{
        createUser(){
            this.v$.$validate();
            if(!this.v$.$error){
                console.log('create user');
            }else{
                console.log('errors');
            }
        }
    }
}
</script>

<style scoped>

</style>
