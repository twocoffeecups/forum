<template>
    <div class="row">
        <div class="card my-3">
            <div class="card-header">
                <h4>Report details</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Reason</dt>
                    <dd v-if="report.reason && report.reason.name" class="col-sm-8">{{ report.reason.name }}</dd>
                    <dt class="col-sm-4">Type</dt>
                    <dd class="col-sm-8">{{ report.type }}</dd>
                    <dt class="col-sm-4">Sender</dt>
                    <dd v-if="report.sender" class="col-sm-8">{{ report.sender.login }}</dd>
                    <dt class="col-sm-4">Status</dt>
                    <dt class="col-sm-8">
                        <span class="">{{ !report.status ? 'New' : 'Process' }}</span>
                    </dt>
                    <dt class="col-sm-4">User</dt>
                    <dd v-if="report.user" class="col-sm-8">{{ report.user.login }}</dd>
                    <dt class="col-sm-4">Created AT</dt>
                    <dd class="col-sm-8">{{ report.created_at }}</dd>

                    <dt class="col-sm-4">Show object</dt>
                    <dd class="col-sm-8">
                          <span role="button" class="fa-pull-right text-primary mx-2" @click="this.showObj = !this.showObj">
                            Show
                          </span>
                    </dd>

                    <dd v-if="showObj" class="col-sm-8 offset-sm-4">
                        <!-- Topic -->
                        <ReportDetailsTopic v-if="report.type==='topic'" :topic="report.object" :images="report.object.images" />
                        <!-- Post -->
                        <ReportDetailsPost v-if="report.type==='post'" :post="report.object"/>
                    </dd>

                    <dt class="col-sm-4">Actions</dt>
                    <dd class="col-sm-8">

                        <div class="d-flex justify-content-start">
                            <div class="mx-3">
                                <input @click="this.reportProcessForm=true" type="radio" class="btn-check mx-3"
                                       name="options-outlined" id="success" autocomplete="off">
                                <label class="btn btn-outline-success" for="success"><i class="far fa-check-circle"></i>
                                    Process</label>
                            </div>

                            <div class="mx-3">
                                <input @click="this.reportProcessForm=false" type="radio" class="btn-check" name="options-outlined"
                                       id="reject" autocomplete="off">
                                <label class="btn btn-outline-danger" for="reject"><i class="fas fa-ban"></i>
                                    Reject</label>
                            </div>
                        </div>
                        <!--              <div class="btn-group">-->
                        <!--                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">-->
                        <!--                  {{ !status ? 'New' : status.title }}-->
                        <!--                </button>-->
                        <!--                <ul class="dropdown-menu">-->
                        <!--                  <li><a class="dropdown-item" v-for="status in reportStatus"  @click="changeStatus(status)" href="#">{{ status.title }}</a></li>-->
                        <!--                </ul>-->
                        <!--              </div>-->
                    </dd>

                </dl>
            </div>
        </div>
    </div>

    <div class="row mt-3 mb-3">
        <div v-if="reportProcessForm" class="card">
            <div class="card-header">
                Process the report
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="userMessage" class="col-sm-2 col-form-label">Message</label>
                    <div class="col-sm-10 mb-3">
                        <textarea id="userMessage" v-model="processReportForm.message" class="form-control"></textarea>
                    </div>
                </div>

                <!-- Confirm / Process -->
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Reason</label>
                    <div class="col-sm-10 mb-3">
                        <select class="form-select">
                            <option v-for="reportReason in reportReasonsTypes" :value="reportReason.id">{{ reportReason.name }}</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="ban-date" class="col-sm-2 col-form-label">Actions</label>
                    <div class="col-sm-10 mb-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="edit-radio" value="0">
                            <label class="form-check-label" for="edit-radio">Edit</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="delete-radio" value="1">
                            <label class="form-check-label" for="delete-radio">Delete</label>
                        </div>
                    </div>
                </div>

                <div class="mb-3 row" >
                    <label for="ban-date" class="col-sm-2 col-form-label">Send a warning to the user</label>
                    <div v-if="report.user" class="col-sm-10 mb-3">
                        <div class="form-check" v-if="!report.user.isWarned">
                            <input @change="this.warning = !this.warning" class="form-check-input" type="checkbox"
                                   value="" id="warningThisTime">
                            <label class="form-check-label" for="warningThisTime">
                                The warning this time
                            </label>
                        </div>
                        <span v-if="report.user.isWarned">The user has already received a warning for violation.</span>
                    </div>
                </div>

                <div v-if="!warning || report.user.isWarned" class="mb-3 row">
                    <label for="ban-date" class="col-sm-2 col-form-label">Ban time</label>
                    <div class="col-sm-10 mb-3">
                        <input type="date" class="" id="ban-date">
                    </div>
                </div>

                <div class="row mb-3">
                    <button @click="processReport" class="btn btn-primary">Send</button>
                </div>

            </div>
        </div>

        <div v-if="!reportProcessForm" class="card">
            <div class="card-header">
                Reject the report
            </div>
            <div class="card-body">
                <div class="mb-3 row">
                    <label for="userMessage" class="col-sm-2 col-form-label">Message</label>
                    <div class="col-sm-10 mb-3">
                        <textarea id="userMessage" v-model="rejectReportForm.message" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <button @click="rejectReport" class="btn btn-primary">Send</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import CreateForumModal from "../../components/admin/CreateForumModal.vue";
import EditForumModal from "../../components/admin/EditForumModal.vue";
import {useToast} from "vue-toastification";
import Post from "../../components/client/Post.vue";
import {mapGetters} from "vuex";
import api from "../../api/api";
import ReportDetailsPost from "../../components/admin/ReportDetailsPost.vue";
import ReportDetailsTopic from "../../components/admin/ReportDetailsTopic.vue";

export default {
    name: "ForumDetails",
    components: {ReportDetailsTopic, ReportDetailsPost, Post, EditForumModal, CreateForumModal},

    setup() {
        return {
            t$: useToast(),
        }
    },

    computed: {
        ...mapGetters({
            report: 'adminReport/getReport',
        }),
    },

    mounted() {
        this.$store.dispatch('adminReport/getReport', this.$route.params.id);
        this.getReportReasonTypes();
    },

    data() {
        return {
            reportReasonsTypes: [],
            showObj: false,

            showForm: false,
            reportProcessForm: true,

            formVisible: true,
            warning: false,
            reportProcessStatus: false,

            processReportForm: {
                message: null,
                reasonId: null,
                banDate: null,
                action: null,
            },
            rejectReportForm: {
                message: null,
            }
        }
    },

    methods: {
        getReportReasonTypes(){
            api.get('/api/admin/report-reason-type/for-form')
                .then(response => {
                    console.log("DATA", response);
                    this.reportReasonsTypes = response.data.reportReasonTypes;
                })
        },

        processReport() {
            console.log('process')
            let data = new FormData();
            for (let [key, value] of Object.entries()) {
                data.append(key, value);
            }
            console.log("PROCESS REPORT:",data);
            // axios.post(`/api/admin/report/${report.id}/process`, {data})
            //     .then(res => {
            //         console.log(res);
            //         this.t$.success("Report process successful.");
            //     })
            //     .catch(error => {
            //         console.log(error);
            //         this.t$.success("Error.");
            //     })
        },

        rejectReport() {
            console.log('REJECT REPORT: ', this.rejectReportForm.message);
            let data = new FormData();
            data.append('message', this.rejectReportForm.message);
            this.$store.dispatch('adminReport/reject', [this.$route.params.id, data]);
            //this.showForm = false;
        }
    }
}
</script>

<style scoped>

</style>
