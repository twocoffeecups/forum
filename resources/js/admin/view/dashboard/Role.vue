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
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>321</td>
                                        <td>Admin</td>
                                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        <td class="d-flex justify-content-around">
                                            <span role="button" class="text-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </span>

                                            <span role="button" class="text-danger" title="Remove">
                                                <i class="fas fa-trash-alt"></i>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>122</td>
                                        <td>User</td>
                                        <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                                        <td class="d-flex justify-content-around">
                                            <span role="button" class="text-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </span>

                                            <span role="button" class="text-danger" title="Remove">
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

export default {
    name: "Role",
    components: {AddRoleModal, Breadcrumbs},

}
</script>

<style scoped>

</style>
