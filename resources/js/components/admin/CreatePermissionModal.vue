<template>
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-success bg-gradient mx-1" data-bs-toggle="modal" data-bs-target="#crate-permission-modal">+ CREATE PERMISSION</button>
    </div>

    <div class="modal fade" id="crate-permission-modal" tabindex="-1" aria-labelledby="add-role-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="create-permission">Add role</h1>
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click.prevent="create" type="button" class="btn btn-primary" data-bs-dismiss="modal">Add
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, minLength, maxLength,} from '@vuelidate/validators'
import {useToast} from "vue-toastification";

export default {
    name: "CreatePermissionModal",

    setup() {
        return {
            v$: useVuelidate(),
            t$: useToast(),
        }
    },

    data() {
        return {
            name: null,
        }
    },

    validations() {
        return {
            name: {required, minLength: minLength(6), maxLength: maxLength(64), $lazy: true},
        }
    },

    methods: {
        create() {
            this.v$.$validate();
            if (!this.v$.$error) {
                this.$store.dispatch('permissions/createPermission', this.name);
            }
        },
    }
}
</script>

<style scoped>

</style>
