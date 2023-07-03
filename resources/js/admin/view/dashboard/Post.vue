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
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title text-bold">Posts</h2>
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
                                        <th>Login</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Reasons</th>
                                        <th>Ban date</th>
                                        <th>Ban type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="user in 5">
                                        <td>183</td>
                                        <td>John Doe</td>
                                        <td>doe123@mail.com</td>
                                        <td>User</td>
                                        <td>11-7-2014</td>
                                        <td>Spam</td>
                                        <td>Temporary</td>
                                        <td><span class="tag tag-success">Banned</span></td>
                                        <td>Buttons</td>
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

export default {
    name:"Post",
    components: {Breadcrumbs},
}
</script>

<style scoped>

</style>
