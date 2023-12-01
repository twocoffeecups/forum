<template>
  <div class="row">
    <div class="card my-3">
      <div class="card-header">
        <h4>User profile</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <dl class="row">
              <dt class="col-sm-4">Name</dt>
              <dd class="col-sm-8">{{ user.name }}</dd>
              <dt class="col-sm-4">Login</dt>
              <dd class="col-sm-8">{{ user.login }}</dd>
              <dt class="col-sm-4">Email</dt>
              <dd class="col-sm-8">{{ user.email }}</dd>
              <dt class="col-sm-4">Role</dt>
              <dd class="col-sm-8">{{ user.role }}</dd>
              <dt class="col-sm-4">Register AT</dt>
              <dd class="col-sm-8">{{ user.register_at }}</dd>
              <dt class="col-sm-4">Email verified</dt>
              <dd class="col-sm-8">{{ user.emailverified_at }}</dd>
            </dl>
          </div>
          <div class="col-6">
            <dl class="row">
              <dt class="col-sm-4">Carma</dt>
              <dd class="col-sm-8">{{ user.carma }}</dd>
              <dt class="col-sm-4">Total topics</dt>
              <dd class="col-sm-8">{{ user.totalTopics }}</dd>
              <dt class="col-sm-4">Total posts</dt>
              <dd class="col-sm-8">{{ user.totalPosts }}</dd>
              <dt class="col-sm-4">Is warning</dt>
              <dd class="col-sm-8">{{ user.isWarning ? 'The user has already received a warning for violation.' : 'No' }}</dd>
              <dt class="col-sm-4">Bane count</dt>
              <dd class="col-sm-8">{{ user.banCount }}</dd>
              <dt class="col-sm-4">In Ban list</dt>
              <dd class="col-sm-8">
                {{ user.inBanList ? `Yes. End date of the ban: ${user.endBan}` : 'No' }}
              </dd>
            </dl>
          </div>
        </div>

      </div>
    </div>
  </div>

</template>

<script>
import axios from "axios";
import {useToast} from "vue-toastification";
export default {
  name: "ForumDetail",

  setup(){
    return{
      t$: useToast(),
    }
  },

  data(){
    return{
      user:{
        id: 1,
        name: 'User Userovich',
        login: 'user123',
        role: 'user',
        email: 'user123@mail.ru',
        emailverified_at: null ?? 'Not verified',
        register_at: '2023-10-14',
        totalTopics: 9,
        totalPosts: 123,
        isWarning: true,
        banCount: 0,
        carma: 316,
        inBanList: true,
        endBan: '2023-12-02'
      },
    }
  },

  methods:{

  }
}
</script>

<style scoped>

</style>