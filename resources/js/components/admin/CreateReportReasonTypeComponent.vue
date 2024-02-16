<template>
    <div class="card" style="border-top: 5px solid #0c63e4">
        <div class="card-header">
            <h4>Create report reason type</h4>
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
                <div :class="{ error: v$.description.$errors.length }">
                    <label for="description" class="col-form-label">Description:</label>
                    <textarea @blur="v$.description.$touch" class="form-control" v-model="description"
                              id="description"></textarea>
                    <div class="input-errors" v-for="error of v$.description.$errors" :key="error.$uid">
                        <div class="error-msg text-danger">{{ error.$message }}</div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button @click="createReportReason" type="button" class="btn btn-primary bg-gradient">
                    Create
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core';
import {required, minLength, maxLength,} from '@vuelidate/validators';

export default {
    name: "CreateReportReasonTypeComponent",

    setup() {
        return {
            v$: useVuelidate(),
        }
    },

    data() {
        return {
            name: null,
            description: null,
        }
    },

    validations() {
        return {
            name: {required, minLength: minLength(2), maxLength: maxLength(36),},
            description: {minLength: minLength(32), maxLength: maxLength(255),},
        }
    },

    methods: {
        createReportReason() {
            this.v$.$validate();
            if (!this.v$.$error) {
                let data = new FormData();
                data.append('name', this.name);
                data.append('description', this.description);
                this.$store.dispatch('reportReason/create', data);
                this.name = '';
                this.description = '';
            }
        }
    }
}
</script>

<style scoped>

</style>
