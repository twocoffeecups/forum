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
                        <CreateReportTypeModal />
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title text-bold">All reports type</h2>
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
                                        <th>Total reports</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="report in reportTypes">
                                        <td>#{{ report.id }}</td>
                                        <td>{{ report.name }}</td>
                                        <td>{{ report.description.substr(0, 140)+'...' }}</td>
                                        <td>0</td>
                                        <td class="d-flex justify-content-around">
                                            <EditReportTypeModal :id="report.id" :name="report.name" :description="report.description" />
                                            <span @click="deleteReport(report.id)" role="button" class="text-danger" title="Remove">
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
import CreateReportTypeModal from "../../component/CreateReportTypeModal.vue";
import axios from "axios";
import EditReportTypeModal from "../../component/EditReportTypeModal.vue";
export default {
    name: "ReportManagement",
    components: {EditReportTypeModal, CreateReportTypeModal, Breadcrumbs},

    data(){
        return{
            reportTypes:[],
        }
    },

    mounted() {
        this.getReportTypes()
    },

    methods:{
        getReportTypes(){
            axios.get('/api/admin/report-type')
            .then(res => {
                console.log(res)
                this.reportTypes = res.data.reportTypes
            })
            .catch(error => {
                console.log(error);
            })
        },

        deleteReport(id){
            axios.delete(`/api/admin/report/report-type/${id}`)
            .then(res => {
                console.log(res);
                this.getReportTypes();
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
