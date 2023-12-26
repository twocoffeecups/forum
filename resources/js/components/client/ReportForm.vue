<template>
    <div class="modal fade" id="report-form" tabindex="-1" aria-labelledby="report-form" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="report-title">{{ $t('component.reportForm.report') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="report-category" class="form-label">{{
                                    $t('component.reportForm.reportCategory')
                                }}:</label>
                            <select id="report-category" v-model="reasonId" class="form-select"
                                    aria-label="report">
                                <option v-for="reportType in reportTypes" :value="reportType.id">{{
                                        reportType.name
                                    }}
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">{{
                                    $t('component.reportForm.message')
                                }}:</label>
                            <textarea class="form-control" v-model="message" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        {{ $t('component.reportForm.close') }}
                    </button>
                    <button @click="sendReport" type="button" data-bs-dismiss="modal" class="btn btn-primary">
                        {{ $t('component.reportForm.sent') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {useToast} from "vue-toastification";
import {mapGetters} from "vuex";

export default {
    name: "ReportForm",
    props: ['reportId', 'type'],

    computed: {
        ...mapGetters({
            reportTypes: "report/getReportTypes",
        }),
    },

    mounted() {
        this.$store.dispatch('report/getReportType');
    },

    setup() {
        return {
            t$: useToast(),
        }
    },

    data() {
        return {
            reasonId: null,
            message: null,
        }
    },

    methods: {
        sendReport() {
            const data = new FormData();
            data.append('reasonId', this.reasonId);
            data.append('postId', this.reportId);
            data.append('message', this.message);
            data.append('type', this.type);
            //this.t$.info('Report send.')
            console.log("REPORT DETAILS", data)
            if(this.type==='post'){
                this.$store.dispatch('report/sendPostReport', [data, this.reportId]);
            }else{
                this.$store.dispatch('report/sendTopicReport', [data, this.reportId]);
            }

        }
    }
}
</script>

<style scoped>

</style>
