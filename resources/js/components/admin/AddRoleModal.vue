<template>
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-primary bg-gradient mx-1" data-bs-toggle="modal" data-bs-target="#add-role-modal">+ ADD ROLE</button>
    </div>

    <div class="modal fade" id="add-role-modal" tabindex="-1" aria-labelledby="add-role-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add-role-label">Add role</h1>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <div :class="{ error: v$.name.$errors.length }">
                            <label for="name" class="col-form-label">Name:</label>
                            <input @blur="v$.name.$touch" type="text" v-model="name" class="form-control" id="name">
                            <div class="input-errors" v-for="error of v$.name.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div :class="{ error: v$.name.$errors.length }">
                            <label class="form-label">Permissions:</label>
                            <div class="mb-1">
                                <small>Add at least one permission.</small>
                            </div>

                            <VueMultiselect
                                id="tags"
                                v-model="selectedPermissions"
                                :options="permissions"
                                :multiple="true"
                                :close-on-select="false"
                                placeholder="Add user permissions"
                                label="option"
                                track-by="option"
                                @blur="v$.selectedPermissions.$touch"
                            />

                            <div class="input-errors" v-for="error of v$.selectedPermissions.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click.prevent="addRole" type="button" class="btn btn-primary" data-bs-dismiss="modal">Add
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, minLength, maxLength,} from '@vuelidate/validators'
import VueMultiselect from "vue-multiselect";
import api from "../../api/api";
import {useToast} from "vue-toastification";

export default {
    name: "AddRoleModal",
    components: {VueMultiselect,},

    setup() {
        return {
            v$: useVuelidate(),
            t$: useToast(),
        }
    },

    created() {
        this.getPermissions();
    },

    data() {
        return {
            name: null,
            permissions: [],
            selectedPermissions: null,
        }
    },

    validations() {
        return {
            name: {required, minLength: minLength(3), maxLength: maxLength(12), $lazy: true},
            selectedPermissions: {required, $lazy: true},
        }
    },

    methods: {
        addRole() {
            this.v$.$validate();
            if (!this.v$.$error) {
                let data = new FormData();
                data.append('name', this.name);
                let permissions = this.selectedPermissions;
                permissions.forEach(permission => {
                    data.append("permissions[]", permission.value)
                })
                api.post('/api/admin/role', data)
                    .then(res => {
                        this.t$.success(res.data.message)
                    })
                    .catch(error => {
                        this.t$.error(error.data.message ?? "Error!");
                    })
            } else {
                this.t$.error("Validation error!");
            }
        },

        getPermissions() {
            api.get('/api/admin/permission/permission-for-form')
                .then(res => {
                    this.permissions = res.data.permissions
                })
                .catch(error => {
                    console.log(error)
                })
        },
    }
}
</script>

<style scoped>

</style>
