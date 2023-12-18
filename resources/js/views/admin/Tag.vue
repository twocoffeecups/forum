<template>
    <div class="row mb-3">
        <div class="container-fluid">

            <!-- Table card -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between my-2">
                        <h4>All Tags</h4>
                        <div>
                            <CreateTagModal/>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-1">
                        <div
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
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                            <tr></tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Author</th>
                                <th scope="col">Topics</th>
                                <th scope="col">Created date</th>
                                <th scope="col">Visibility</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="tag in tags">
                                <th scope="row">{{ tag.id }}</th>
                                <td contenteditable @focusout.prevent="renameTag($event, tag.id, tag.name)">{{ tag.name }}</td>
                                <td>
                                    {{ tag.author }}
                                </td>
                                <td>{{ tag.topics }}</td>
                                <td>{{ tag.created_at }}</td>
                                <th>
                                    <div class="btn-group  btn-group-sm" role="group"
                                         aria-label="Basic radio toggle button group"
                                         @change.prevent="changeVisibility($event, tag.id)">
                                        <input type="radio" class="btn-check" :name="tag.id+'isPublished'"
                                               :id="tag.id+'hide'" value="false" autocomplete="off"
                                               :checked="tag.status != true">
                                        <label class="btn btn-outline-secondary" :for="tag.id+'hide'">Hide</label>

                                        <input type="radio" class="btn-check" :name="tag.id+'isPublished'"
                                               :id="tag.id+'published'" value="true" autocomplete="off"
                                               :checked="tag.status == true">
                                        <label class="btn btn-outline-success" :for="tag.id+'published'">Publish</label>
                                    </div>

                                </th>
                                <td>
                                    <span @click="deleteTag(tag.id)" role="button" class="text-danger mx-2"
                                          title="Edit">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-between">
                        <div class="d-flex mt-1 d-none d-md-block d-lg-block d-xl-block align-items-center">
                            <div class="table-info" id="table-info" role="status" aria-live="polite">Showing 4 to 10 of
                                4
                                entries
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-1">
                            <nav>
                                <ul class="pagination" style="color: black">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Предыдущая">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Следующая">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
import CreateTagModal from "../../components/admin/CreateTagModal.vue";
import api from "../../api/api";
import {useToast} from "vue-toastification";

export default {
    name: "Tag",
    components: {CreateTagModal},

    setup(){
        return{
            t$: useToast(),
        }
    },

    mounted() {
        this.getTags();
    },

    data() {
        return {
            tags: [],
            visibility: null,

        }
    },

    methods: {
        getTags() {
            api.get('/api/admin/tag')
                .then(res => {
                    this.tags = res.data.tags
                    console.log(this.tags);
                })
        },

        renameTag(event, id, tagName){
            let name = event.target.innerText;
            if (name == tagName) return;
            if (name.length < 3) {
                this.t$.error("Min length 3.");
                return;
            }
            api.patch(`/api/admin/tag/${id}`, {
                name: name,
            })
                .then(res => {
                    this.t$.success("Tag rename successfully.")
                })
                .catch(error => {
                    this.t$.error(error.response.data.message ?? "Error!");
                })
        },

        deleteTag(id) {
            api.delete(`/api/admin/tag/${id}`)
                .then(res => {
                    this.t$.success("Tag delete successfully");
                    this.getTags();
                })
                .catch(error => {
                    this.t$.error(error.response.data.message ?? "Error!");
                })
        },

        changeVisibility(event, tagId) {
            let value = event.target.value;
            api.patch(`/api/admin/tag/${tagId}/status`, {
                visibility: value,
            })
                .then(res => {
                    this.t$.success("Tag visibility change successfully!");
                })
                .catch(error => {
                    this.t$.error(error.response.data.message ?? "Error!");
                })

        },
    }
}
</script>

<style scoped>

</style>
