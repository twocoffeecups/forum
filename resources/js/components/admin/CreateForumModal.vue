<template>
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#create-category-modal">+ CRETE
            FORUM
        </button>
    </div>

    <div class="modal fade" id="create-category-modal" tabindex="-1" aria-labelledby="create-category-modal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Create forum</h1>
                </div>
                <div class="modal-body">

                    <div class="mb-3 form-group">
                        <div :class="{ error: v$.name.$errors.length }">
                            <label for="name" class="col-form-label">Name:</label>
                            <input @blur="v$.name.$touch" type="text" v-model="name" class="form-control" id="name">
                            <div class="input-errors" v-for="error of v$.name.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-check-label" for="type">Type</label>
                        <select @change="this.forumType = $event.target.value" class="form-control">
                            <option value="0">Forum category</option>
                            <option value="1">Forum</option>
                        </select>
                    </div>

                    <div class="mb-3 form-check">
                        <input v-model="isChild" type="checkbox" :disabled="forumType==0" class="form-check-input"
                               id="is-child">
                        <label class="form-check-label" for="is-child">Child category</label>
                    </div>

                    <div v-if="isChild" class="mb-3 form-group">
                        <select v-model="selectedForum" @change="changeForum($event)" class="form-control">
                            <ForumOptionTree v-for="forum in forums" :is-selected="selectedForum" :name="forum.name"
                                             :id="forum.id" :children="forum.children" :indent="0"/>
                        </select>
                    </div>

                    <div class="mb-3 form-group">
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
                    <button @click="createForum" data-bs-dismiss="modal" type="button" class="btn btn-primary">Create
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useVuelidate} from '@vuelidate/core';
import {required, minLength, maxLength,} from '@vuelidate/validators';
import ForumOptionTree from "./ForumOptionTree.vue";
import api from "../../api/api";

export default {
    name: "CreateForumModal",
    components: {ForumOptionTree,},
    props: ['parentId'],

    mounted() {
        this.getForums();
    },

    setup() {
        return {
            v$: useVuelidate()
        }
    },

    watch: {
        parentId(val){
            if(this.parentId){
                this.forumType = 1;
                this.isChild = true;
                this.selectedForum = val;
            }
        },
    },

    data() {
        return {
            name: null,
            isChild: false,
            description: null,
            forumType: 0,

            isSelected: null,
            showCategory: null,
            selectedForum: null,
            forums: [],
        }
    },

    validations() {
        return {
            name: {required, minLength: minLength(3), maxLength: maxLength(64),},
            description: {maxLength: maxLength(255),},
        }
    },

    methods: {
        createForum() {
            this.v$.$validate();
            if (!this.v$.$error) {
                let parentId = this.isChild && this.type != 0 ? this.selectedForum : null;
                const data = new FormData();
                data.append('parentId', parentId);
                data.append('type', this.forumType);
                data.append('name', this.name);
                data.append('description', this.description);
                this.$store.dispatch('adminForum/createForum', data);
                this.name = null;
                this.description = null;
                this.forumType = 0;
            }
        },

        getForums() {
            api.get(`/api/admin/forum`)
                .then(res => {
                    this.forums = res.data.forums
                })
        },

        changeForum(e) {
            this.selectedForum = e.target.value
        },
    }
}
</script>

<style scoped>

</style>
