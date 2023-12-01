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
              <label for="report-category" class="form-label">{{ $t('component.reportForm.reportCategory') }}:</label>
              <select id="report-category" v-model="reportCategory" class="form-select" aria-label="report">
                <option v-for="category in reportCategories" :value="category.id">{{ category.label }}</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="message-text" class="col-form-label">{{ $t('component.reportForm.message') }}:</label>
              <textarea class="form-control" v-model="message" id="message-text"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $t('component.reportForm.close') }}</button>
          <button @click="sendReport" type="button" data-bs-dismiss="modal" class="btn btn-primary">{{ $t('component.reportForm.sent') }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {useToast} from "vue-toastification";

export default {
  name: "ReportForm",
  props:['reportId'],

  setup(){
    return{
      t$: useToast(),
    }
  },

  data(){
    return{
      reportCategory:null,
      message:null,

      reportCategories:[
        {
          id: 1,
          label: 'Spam',
        },
        {
          id: 2,
          label: 'Violence',
        },
        {
          id: 3,
          label: 'Pornography',
        },
        {
          id: 4,
          label: 'Illegal drugs',
        },
        {
          id: 5,
          label: 'Other',
        },
      ],
    }
  },

  methods:{
    sendReport(){
      console.log('Send report.', this.reportId)
      console.log('Message: ', this.message)
      console.log('Category: ', this.reportCategory)
      this.t$.info('Report send.')
    }
  }
}
</script>

<style scoped>

</style>