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
                        <div class="d-flex justify-content-start mb-3">
                            <AddRoleModal />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title text-bold">Roles</h2>
                            </div>

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Permissions</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="role in roles">
                                            <td>#{{ role.id }}</td>
                                            <td>{{ role.name }}</td>
                                            <td>All</td>
                                            <td class="d-flex justify-content-around">
                                                <EditRoleModal :id="role.id" :name="role.name" />

                                                <span @click="deleteRole(role.id)" role="button" class="text-danger" title="Remove">
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
import AddRoleModal from "../../component/AddRoleModal.vue";
import EditRoleModal from "../../component/EditRoleModal.vue";

export default {
    name: "Role",
    components: {EditRoleModal, AddRoleModal, Breadcrumbs},

    mounted() {
        this.getRoles()
    },

    data(){
        return{
            roles:[],
        }
    },

    methods:{
        getRoles(){
            axios.get('/api/admin/role')
            .then(res =>{
                console.log(res);
                this.roles = res.data.roles
            })
            .catch(error => {
                console.log(error);
            })
        },

        deleteRole(id){
            axios.delete(`/api/admin/role/${id}`)
                .then(res =>{
                    console.log(res);
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
