<template>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between my-2">
                <h4>All types</h4>
                <div class="d-flex">

                    <TopicRejectTypeCreateModal/>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div v-if="rejectTypes.length!==0">
                <div class="table-responsive mb-1">
                    <div v-if="rejectTypes!==0"
                        class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                        <div class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
                        <span class="form-text">
                          Show
                        </span>
                            <select class="form-select form-select-sm mx-2" aria-label="Select entries">
                                <option value="10" selected>10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                            </select>
                            <span class="form-text">entries</span>
                        </div>
                        <div class="d-flex mx-2 my-2">
                            <label class="form-text mx-1">Search: </label>
                            <input type="search" class="form-control" id="search" style="max-height: 20px;"/>
                        </div>
                    </div>

                    <!-- Table -->
                    <table v-if="rejectTypes!==0" class="table table-striped table-hover table-bordered">
                        <thead class="table-primary">
                        <tr></tr>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Status</th>
                            <th scope="col">Change status</th>
                            <th scope="col">Created AT</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="type in rejectTypes">
                            <th scope="row">{{ type.id }}</th>
                            <td contenteditable @focusout.prevent="updateRejectType($event, type.id, type.title)">
                                {{ type.title }}
                            </td>
                            <td>{{ type.author }}</td>
                            <td><b>{{ type.status ? 'Published' : 'Unpublished' }}</b></td>
                            <td>{{ type.created_at }}</td>
                            <td>
                                <div class="btn-group  btn-group-sm" role="group"
                                     aria-label="Basic radio toggle button group"
                                     @change.prevent="changeStatus(type.id)">
                                    <input type="radio" class="btn-check" :name="type.id+'isPublished'"
                                           :id="type.id+'hide'" value="false" autocomplete="off"
                                           :checked="type.status != true">
                                    <label class="btn btn-outline-secondary" :for="type.id+'hide'">Hide</label>

                                    <input type="radio" class="btn-check" :name="type.id+'isPublished'"
                                           :id="type.id+'published'" value="true" autocomplete="off"
                                           :checked="type.status == true">
                                    <label class="btn btn-outline-success"
                                           :for="type.id+'published'">Publish</label>
                                </div>
                            </td>
                            <td>
                                <span @click.prevent="deleteRejectType(type.id)" role="button" class="text-danger mx-2"
                                      title="Delete">
                                    <i class="fas fa-trash"></i>
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>


                </div>


            </div>

            <div v-if="rejectTypes.length===0" class="text-center">
                <h4>It's empty here...</h4>
            </div>
        </div>
    </div>
</template>

<script>
import TopicRejectTypeCreateModal from "../../components/admin/TopicRejectTypeCreateModal.vue";
import {mapGetters} from "vuex";

export default {
    name: "Role",
    components: {TopicRejectTypeCreateModal,},

    computed: {
        ...mapGetters({
            rejectTypes: 'rejectType/getRejectTypes',
        }),
    },

    mounted() {
        this.$store.dispatch("rejectType/getRejectTypes");
    },

    methods: {
        changeStatus(id) {
            this.$store.dispatch('rejectType/changeStatus', id);
        },

        deleteRejectType(id) {
            this.$store.dispatch('rejectType/delete', id);
        },

        updateRejectType(event, id, oldTitle) {
            let title = event.target.innerText;
            if (title == oldTitle) return;
            if (title.length < 6) {
                this.t$.error("Min length 6.");
                return;
            }
            this.$store.dispatch('rejectType/update', [id, title]);
        }
    },
}
</script>

<style>

</style>
