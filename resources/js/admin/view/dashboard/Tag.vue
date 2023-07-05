<template>
    <div class="content-wrapper">
        <!-- Breadcrumbs -->
        <Breadcrumbs />
        <!-- /. Breadcrumbs -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <CreateTagModal />
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title text-bold">Tags</h2>
                                <div class="card-tools">
                                    <div class="input-group input-group-sm" style="width: 200px;">
                                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Topics</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="tag in tags">
                                            <td>#{{ tag.id }}</td>
                                            <td>{{ tag.name }}</td>
                                            <td>{{ tag.description.substr(0, 140)+'...' }}</td>
                                            <td>63</td>
                                            <td class="d-flex justify-content-around">
                                                <EditTagModal :id="tag.id" :name="tag.name" :description="tag.description" />

                                                <span @click="deleteTag(tag.id)" role="button" class="text-danger" title="Remove">
                                                   <i class="fas fa-trash-alt"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->

    </div>
</template>

<script>
import Breadcrumbs from "../../component/Breadcrumbs.vue";
import CreateTagModal from "../../component/CreateTagModal.vue";
import EditTagModal from "../../component/EditTagModal.vue";
export default{
    name:'Tag',
    components: {EditTagModal, CreateTagModal, Breadcrumbs},

    data(){
        return{
            tags:[],
        }
    },

    mounted() {
        this.getTags()
    },

    methods:{
        getTags(){
            axios.get('/api/admin/forum/tag/')
            .then(res => {
                this.tags = res.data.tags
                console.log(this.tags);
            })
            .catch(error => {
                console.log(error);
            })
        },

        deleteTag(id){
            axios.delete(`/api/admin/forum/tag/${id}`)
            .then(res => {
                console.log(res);
            })
            .catch(error => {
                console.log(error);
            })
        },
    }
}
</script>

<style scoped>

</style>
