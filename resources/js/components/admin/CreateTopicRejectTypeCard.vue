<template>

    <div class="card" style="border-top: 5px solid #0c63e4">
        <div class="card-header">
            <h4>Create rejected type</h4>
        </div>
        <div class="card-body">
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
            <div class="d-flex justify-content-end">
                <button @click.prevent="createRejectType" type="button" class="btn btn-primary">
                    Create
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core'
import {required, minLength, maxLength,} from '@vuelidate/validators'

export default {
    name: "CreateTopicRejectTypeCard",
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
