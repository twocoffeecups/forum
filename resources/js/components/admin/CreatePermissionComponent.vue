<template>
    <div class="card" style="border-top: 5px solid #0c63e4">
        <div class="card-header">
            <h4>Create permission</h4>
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
                <button @click.prevent="create" type="button" class="btn btn-primary">
                    Add
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, minLength, maxLength,} from '@vuelidate/validators'
import {useToast} from "vue-toastification";

export default {
    name: "CreatePermissionComponent",

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
                this.name = '';
            }
        },
    }
}
</script>

<style scoped>

</style>
