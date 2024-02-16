<template>
    <div class="card" style="border-top: 5px solid #0c63e4">
        <div class="card-header">
            <h4>Create new tag</h4>
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
            <div class="row mb-2">
                <div class="d-flex justify-content-end">
                    <button @click="createTag" type="button" class="btn btn-primary bg-gradient">
                        Create
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core';
import {required, minLength, maxLength,} from '@vuelidate/validators';

export default {
    name: "CreateTagCard",

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
        createTag() {
            this.v$.$validate();
            if (!this.v$.$error) {
                this.$store.dispatch('tag/createTag', [this.name, this.description]);
                this.name = null;
                this.description = null;
            }
        }
    }
}
</script>

<style scoped>

</style>
