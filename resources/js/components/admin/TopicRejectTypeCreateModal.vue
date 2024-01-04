<template>
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-primary bg-gradient mx-1" data-bs-toggle="modal" data-bs-target="#reject-type-modal">+ CREATE REJECT TYPE</button>
    </div>

    <div class="modal fade" id="reject-type-modal" tabindex="-1" aria-labelledby="reject-type-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add-role-label">Create reject type</h1>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <div :class="{ error: v$.title.$errors.length }">
                            <label for="name" class="col-form-label">Name:</label>
                            <input @blur="v$.title.$touch" type="text" v-model="title" class="form-control" id="name">
                            <div class="input-errors" v-for="error of v$.title.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click.prevent="createRejectType" type="button" class="btn btn-primary" data-bs-dismiss="modal">Create
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, minLength, maxLength,} from '@vuelidate/validators'

export default {
    name: "TopicRejectTypeCreateModal",
    components: {},

    setup() {
        return {
            v$: useVuelidate(),
        }
    },

    created() {

    },

    data() {
        return {
            title: null,
        }
    },

    validations() {
        return {
            title: {required, minLength: minLength(3), maxLength: maxLength(64), $lazy: true},
        }
    },

    methods: {
        createRejectType(){
            this.v$.$validate();
            if (!this.v$.$error) {
                const data = new FormData();
                data.append('title', this.title);
                this.$store.dispatch('rejectType/createRejectType', data);
                this.title  = null;
            }
        }
    },
}
</script>

<style scoped>

</style>
