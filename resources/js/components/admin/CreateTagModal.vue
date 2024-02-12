<template>
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-primary bg-gradient mx-1" data-bs-toggle="modal" data-bs-target="#create-tag-modal">
            <i class="fas fa-plus mx-1"></i>Add tag
        </button>
    </div>

    <div class="modal fade" id="create-tag-modal" tabindex="-1" aria-labelledby="create-tag-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Create tag</h1>
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
                        <div :class="{ error: v$.description.$errors.length }">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea @blur="v$.description.$touch" class="form-control" v-model="description"
                                      id="description"></textarea>
                            <div class="input-errors" v-for="error of v$.description.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary bg-gradient" data-bs-dismiss="modal">Close</button>
                    <button @click="createTag" data-bs-dismiss="modal" type="button"
                            class="btn btn-primary bg-gradient">Create
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
    name: "CreateTagModal",

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
            }
        }
    }
}
</script>

<style scoped>

</style>
