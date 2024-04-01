<template>
    <div v-if="checkHasPermissions([AccessPermissions.CAN_CREATE_ROLE])" class="card mb-3" style="border-top: 5px solid #0c63e4">
        <div class="card-header">
            <h4>Create role</h4>
        </div>
        <div class="card-body">
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

            <div class="mb-3">
                <button @click.prevent="createRole" type="button" class="btn btn-primary bg-gradient">
                    Create
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, minLength, maxLength,} from '@vuelidate/validators'
import VueMultiselect from "vue-multiselect";
import {mapGetters} from "vuex";
import api from "../../api/api";
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";
export default {
    name: "CreateRoleComponent",
    components: {VueMultiselect,},

    computed: {
        ...mapGetters({

        }),
    },

    setup() {
        return {
            v$: useVuelidate(),
            checkHasPermissions,
            AccessPermissions,
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
        createRole() {
            this.v$.$validate();
            if (!this.v$.$error) {
                let data = new FormData();
                data.append('name', this.name);
                let permissions = this.selectedPermissions;
                permissions.forEach(permission => {
                    data.append("permissions[]", permission.value)
                })
                this.$store.dispatch('role/createRole', data);
            }
        },

        getPermissions() {
            return new Promise((resolve, reject) => {
                api.get('/api/admin/permission/permission-for-form')
                    .then(response => {
                        if(response.data){
                            this.permissions = response.data.permissions;
                            resolve(response);
                        }else{
                            reject(response);
                        }
                    })
                    .catch(error => {
                        reject(error)
                    })
            });
        },
    }
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">

</style>
