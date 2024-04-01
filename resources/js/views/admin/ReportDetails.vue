<template>
    <div class="row">
        <div class="col-md-5">
            <div class="card" style="border-top: 5px solid #0c63e4">
                <div class="card-header">
                    <h4>Report details</h4>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <div class="row align-items-start mb-2">
                            <div class="col-5">
                                <b>Reason</b>
                            </div>
                            <div class="col-7">
                                <span v-if="report.reason && report.reason.name">{{ report.reason.name }}</span>
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col-5">
                                <b>Reason</b>
                            </div>
                            <div class="col-7">
                                <span>{{  report.type }}</span>
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col-5">
                                <b>Sender</b>
                            </div>
                            <div class="col-7">
                                <span v-if="report.sender">{{ report.sender.name }}</span>
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col-5">
                                <b>Status</b>
                            </div>
                            <div class="col-7">
                                <span :class="`badge ${!report.closed ? 'bg-danger' : 'bg-success'}`">{{ !report.closed ? 'New' : 'Closed' }}</span>
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col-5">
                                <b>User</b>
                            </div>
                            <div class="col-7">
                                <span v-if="report.user">{{ report.user.name }}<i v-if="report.user.isBanned"> (The user is on the ban list)</i> </span>
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col-5">
                                <b>Created</b>
                            </div>
                            <div class="col-7">
                                <span>{{ report.created_at }}</span>
                            </div>
                        </div>
                        <div class="row align-items-start mb-2">
                            <div class="col-5">
                                <b>Show object</b>
                            </div>
                            <div class="col-7">
                               <span role="button" class="fa-pull-right text-primary mx-2" @click="this.showObj = !this.showObj">
                                    Show
                                </span>
                            </div>
                        </div>
                        <div v-if="showObj" class="row align-items-start mb-2">
                            <div class="col-12">
                                <!-- Topic -->
                                <TopicMainPostComponent v-if="report.type==='topic'" :topic="report.object" :images="report.object.images" />
                                <!-- Post -->
                                <PostComponent v-if="report.type==='post'" :post="report.object"/>
                            </div>
                        </div>
                        <div v-if="checkHasPermissions([AccessPermissions.CAN_PROCESS_REPORT, AccessPermissions.CAN_REJECT_REPORT])" class="row align-items-start mb-2">
                            <div class="col-5">
                                <b>Actions</b>
                            </div>
                            <div v-if="!report.closed" class="col-7">
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
                            </div>
                            <div v-if="report.closed" class="col-7">
                                <span>Report closed</span>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <div  v-if="checkHasPermissions([AccessPermissions.CAN_PROCESS_REPORT, AccessPermissions.CAN_REJECT_REPORT])" class="col-md-7">
            <!-- Forms -->
            <div v-if="!report.closed">
                <div v-if="reportProcessForm" class="card mb-3" style="border-top: 5px solid #0c63e4">
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
                                <select v-model="processReportForm.reasonId" class="form-select">
                                    <option v-if="report.reason" v-for="reportReason in reportReasonsTypes" :selected="report.reason.id==reportReason.id" :value="reportReason.id">{{ reportReason.name }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="ban-date" class="col-sm-2 col-form-label">Actions</label>
                            <div class="col-sm-10 mb-3">
                                <div v-if="report.type==='topic'" class="form-check form-check-inline">
                                    <input v-model="processReportForm.action" class="form-check-input" type="radio" name="inlineRadioOptions" id="edit-radio" value="0">
                                    <label class="form-check-label" for="edit-radio">Edit</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input v-model="processReportForm.action" class="form-check-input" type="radio" name="inlineRadioOptions" id="delete-radio" value="1">
                                    <label class="form-check-label" for="delete-radio">Delete</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 row" >
                            <label for="ban-date" class="col-sm-2 col-form-label">Send a warning to the user</label>
                            <div v-if="report.user" class="col-sm-10 mb-3">
                                <div class="form-check" v-if="!report.user.isWarned && !report.user.isBanned">
                                    <input v-model="processReportForm.warn" class="form-check-input" type="checkbox"
                                           value="" id="warningThisTime">
                                    <label class="form-check-label" for="warningThisTime">
                                        The warning this time
                                    </label>
                                </div>
                                <span v-if="report.user.isWarned || report.user.isBanned">The user has already received a warning for violation.</span>
                            </div>
                        </div>

                        <div v-if="!processReportForm.warn || report.user.isWarned || processReportForm.addBanTime" class="mb-3 row">
                            <label for="ban-date" class="col-sm-2 col-form-label">Ban time</label>
                            <div class="col-sm-10 mb-3">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12 col-xl-3">
                                        <input v-model="totalDaysBan" type="number" id="total-day-ban" min="5" max="30" />
                                        <label class="form-label mx-2" for="total-day-ban">Days</label>
                                    </div>
                                    <div v-if="report.user && report.user.isBanned" class="col-12 col-md-12  col-lg-12 col-xl-9">
                                        <span class=""><i>The user is on the ban list.The duration of the ban will be increased by the specified number of days.</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button @click="processReport" class="btn btn-primary">Send</button>
                        </div>

                    </div>
                </div>

                <div v-if="!reportProcessForm" class="card mb-3" style="border-top: 5px solid #0c63e4">
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

                        <div class="mb-3">
                            <button @click="rejectReport" class="btn btn-primary">Send</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Report closed -->
            <div v-if="report.closed">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="my-4">Report closed.</h4>
                    </div>
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
import PostComponent from "../../components/admin/PostComponent.vue";
import TopicMainPostComponent from "../../components/admin/TopicMainPostComponent.vue";
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";
export default {
    name: "ForumDetails",
    components: {TopicMainPostComponent, PostComponent, Post, EditForumModal, CreateForumModal},

    setup() {
        return {
            t$: useToast(),
            checkHasPermissions,
            AccessPermissions,
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
            reportProcessForm: true,
            processReportForm: {
                message: null,
                reasonId: null,
                action: 1,
                warn: false,
            },
            totalDaysBan: null,
            rejectReportForm: {
                noViolations: false,
                message: null,
            }
        }
    },

    methods: {
        getReportReasonTypes(){
            api.get('/api/admin/report-reason-type/for-form')
                .then(response => {
                    this.reportReasonsTypes = response.data.reportReasonTypes;
                })
        },

        processReport() {
            if (this.report.closed === 1) return;
            let data = new FormData();
            for (let [key, value] of Object.entries(this.processReportForm)) {
                data.append(key, value);
            }
            if(this.totalDaysBan!==null && this.processReportForm.warn===false){
                data.append("totalDaysBan", this.totalDaysBan);
            }
            this.$store.dispatch('adminReport/processing', [this.$route.params.id, data]);
        },

        rejectReport() {
            if (this.report.closed === 1) return;
            let data = new FormData();
            data.append('message', this.rejectReportForm.message);
            data.append('noViolations', this.rejectReportForm.noViolations);
            console.log(data.totalDaysBan)
            this.$store.dispatch('adminReport/reject', [this.$route.params.id, data]);
        }
    }
}
</script>

<style scoped>

</style>
