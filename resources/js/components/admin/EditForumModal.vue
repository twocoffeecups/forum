<template>
    <button class="btn btn-primary" data-bs-toggle="modal" :data-bs-target="`#edit-forum-${id}-modal`" title="Edit">
        Edit
    </button>

    <div class="modal fade" :id="`edit-forum-${id}-modal`" tabindex="-1" :aria-labelledby="`edit-forum-${id}-modal`"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit forum</h1>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click="updateForum" data-bs-dismiss="modal" type="button" class="btn btn-primary">Update
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import {useVuelidate} from "@vuelidate/core";
import {maxLength, minLength, required} from "@vuelidate/validators";

export default {
    name: "EditForumModal",
    props: ['id', 'forumName', 'forumDescription',],

    setup() {
        return {
            v$: useVuelidate()
        }
    },

    data() {
        return {
            name: this.forumName,
            description: this.forumDescription,
        }
    },

    validations() {
        return {
            name: {required, minLength: minLength(2), maxLength: maxLength(24),},
            description: {required, minLength: minLength(32), maxLength: maxLength(255),},
        }
    },

    methods: {
        async updateForum() {
            this.v$.$validate();
            const data = new FormData();
            data.append('name', this.name);
            data.append('description', this.description)
            data.append('_method', 'patch');
            this.$store.dispatch('adminForum/updateForumContent', [this.id, data]);
        }
    }
}
</script>

<style scoped>

</style>
