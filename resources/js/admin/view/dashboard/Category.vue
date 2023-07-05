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
                        <CreateCategoryModal />
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title text-bold">Categories</h2>
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
                                        <th>Parent category</th>
                                        <th>Description</th>
                                        <th>Topics</th>
                                        <th>Posts</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <template  v-for="category in categories">
                                        <tr>
                                            <td>#{{ category.id }}</td>
                                            <td>{{ category.name }}</td>
                                            <td>{{ '-' }}</td>
                                            <td>{{ category.description.substr(0, 140)+'...' }}</td>
                                            <td>9</td>
                                            <td>63</td>
                                            <td class="d-flex justify-content-around">
                                                <EditCategoryModal :id="category.id" :parent-id="category.parentId" :name="category.name" :description="category.description" />

                                                <span @click="deleteCategory(category.id)" role="button" class="text-danger" title="Remove">
                                                    <i class="fas fa-trash-alt"></i>
                                                </span>
                                            </td>
                                        </tr>
                                    </template>

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
import CreateCategoryModal from "../../component/CreateCategoryModal.vue";
import EditCategoryModal from "../../component/EditCategoryModal.vue";

export default {
    name:"Category",
    components: {EditCategoryModal, CreateCategoryModal, Breadcrumbs},

    mounted() {
      this.getCategories()
    },

    data(){
        return{
            categories:[],
        }
    },

    methods:{
        getCategories(){
            axios.get('/api/admin/forum/category')
            .then(res => {
                this.categories = res.data.categories
                console.log(this.categories)
            })
            .catch(error => {
                console.log(error)
            })
        },

        deleteCategory(id){
            axios.delete(`/api/admin/forum/category/${id}`)
            .then(res => {
                console.log(res)
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>

</style>
