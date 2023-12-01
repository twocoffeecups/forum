<template>
  <div class="row">
      <div class="card my-3">
        <div class="card-header">
          <h4>Report details</h4>
        </div>
        <div class="card-body">
          <dl class="row">
            <dt class="col-sm-4">Reason</dt>
            <dd class="col-sm-8">AAAAAAAAAAAAAAAAAAAAAAAA</dd>
            <dt class="col-sm-4">Sender</dt>
            <dd class="col-sm-8">User Userovich</dd>
            <dt class="col-sm-4">Status</dt>
            <dt class="col-sm-8">
              <span class="px-1 rounded bg-danger">New</span>
            </dt>
            <dt class="col-sm-4">User</dt>
            <dd class="col-sm-8">Ashot Cumshotovich</dd>
            <dt class="col-sm-4">Created AT</dt>
            <dd class="col-sm-8">2023-10-29</dd>

            <dt class="col-sm-4">Post</dt>
            <dd class="col-sm-8">
              <span role="button" class="fa-pull-right text-primary mx-2" @click="this.showPost = !this.showPost">
                Show post
              </span>
            </dd>

            <dd v-if="showPost" class="col-sm-8 offset-sm-4">
              <Post />
            </dd>

            <dt class="col-sm-4">Actions</dt>
            <dd class="col-sm-8">

              <div class="d-flex justify-content-start">
                <div class="mx-3">
                  <input @click="this.showForm = true" type="radio" class="btn-check mx-3" name="options-outlined" id="success" autocomplete="off">
                  <label class="btn btn-outline-success" for="success"><i class="far fa-check-circle"></i> Process</label>
                </div>

                <div class="mx-3">
                  <input @click="rejectReport" type="radio" class="btn-check"  name="options-outlined" id="reject" autocomplete="off">
                  <label class="btn btn-outline-danger" for="reject"><i class="fas fa-ban"></i> Reject</label>
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
    <div v-if="showForm && !report.status" class="card">
      <div class="card-header">
        Process the report
      </div>
      <div class="card-body">
<!--        <div class="mb-3 row">-->
<!--          <label class="col-sm-2 col-form-label">Type</label>-->
<!--          <div class="col-sm-10 mb-3">-->

<!--            <div class="d-flex justify-content-start">-->
<!--              <div class="mx-3">-->
<!--                <input type="radio" class="btn-check mx-3" name="options-outlined" id="success" autocomplete="off" checked>-->
<!--                <label class="btn btn-outline-success" for="success">Process</label>-->
<!--              </div>-->

<!--              <div class="mx-3">-->
<!--                <input type="radio" class="btn-check"  name="options-outlined" id="reject" autocomplete="off">-->
<!--                <label class="btn btn-outline-danger" for="reject">Reject</label>-->
<!--              </div>-->
<!--            </div>-->

<!--          </div>-->
<!--        </div>-->

        <div class="mb-3 row">
          <label for="userMessage" class="col-sm-2 col-form-label">Message</label>
          <div class="col-sm-10 mb-3">
            <textarea id="userMessage" v-model="reportForm.message" class="form-control"></textarea>
          </div>
        </div>

        <!-- Confirm / Process -->
        <div class="mb-3 row">
          <label class="col-sm-2 col-form-label">Reason</label>
          <div class="col-sm-10 mb-3">
            <select class="form-select">
              <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>
            </select>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="ban-date" class="col-sm-2 col-form-label">Actions</label>
          <div class="col-sm-10 mb-3">
            <span>Delete post | Edit post</span>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="ban-date" class="col-sm-2 col-form-label">User</label>
          <div class="col-sm-10 mb-3">
            <span>The user <i>Ashot Cumshotovich</i> has already received a warning for violation.</span>
          </div>
        </div>

        <div class="mb-3 row">
          <label for="ban-date" class="col-sm-2 col-form-label">Received</label>
          <div class="col-sm-10 mb-3">
            <div class="form-check">
              <input @change="this.warning = !this.warning" class="form-check-input" type="checkbox" value="" id="warningThisTime">
              <label class="form-check-label" for="warningThisTime">
                The warning this time
              </label>
            </div>
          </div>
        </div>

        <div v-if="!warning" class="mb-3 row">
          <label for="ban-date" class="col-sm-2 col-form-label">Ban time</label>
          <div class="col-sm-10 mb-3">
            <input type="date" class="" id="ban-date">
          </div>
        </div>

        <div class="row mb-3">
          <button @click="processComplaint" class="btn btn-primary">Send</button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import CreateForumModal from "../../components/admin/CreateForumModal.vue";
import EditForumModal from "../../components/admin/EditForumModal.vue";
import axios from "axios";
import {useToast} from "vue-toastification";
import Post from "../../components/client/Post.vue";
export default {
  name: "ForumDetail",
  components: {Post, EditForumModal, CreateForumModal},

  setup(){
    return{
      t$: useToast(),
    }
  },

  data(){
    return{
      report:{
        id: 1,
        reason: 'AAAAAAAAAA',
        sender: 'User Userovich',
        user: 'Ashot Cumshtovich',
        new: true,
        status: false,
      },

      showPost: false,
      showForm: false,
      formVisible: true,
      warning: false,
      reportProcessStatus: false,
      reportForm:{
        message: null,
        reasonId: null,
        banDate: null,
        action: null,
      },
    }
  },

  methods:{
    changeForm(e){
      console.log('change form')
    },

    processComplaint(){
      console.log('process')
      let data = new FormData();
      for ([key, value] of Object.entries()){
        data.append(key, value);
      }
      axios.post(`/api/admin/report/${report.id}/process`, {data})
      .then(res => {
        console.log(res);
        this.t$.success("Report process successful.");
      })
      .catch(error => {
        console.log(error);
        this.t$.success("Error.");
      })
    },

    changeStatus(status){
      console.log('change status')
      console.log(status)
      this.status = status;
    },

    rejectReport(){
      console.log('reject report')
      this.showForm = false;
      // axios.post(`/api/admin/report/${1}/reject`, {
      //
      // })
      //   .then(res => {
      //     console.log(res)
      //     this.t$.success("Report rejected.");
      //   })
      //   .catch(error => {
      //     console.log(error)
      //     this.t$.error("Error.");
      //   })
    }
  }
}
</script>

<style scoped>

</style>