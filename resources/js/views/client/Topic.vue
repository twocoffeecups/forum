<template>
    <div class="container-fluid container-lg container-md">
    <div class="row">

      <div class="col-lg-9 col-md-12 col-sm-12 mb-3">

        <!-- Main content -->
        <div class="card" style="border-radius: 1rem;">
          <div class="card-header">
            <!-- Page head -->
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                  <div class="d-flex">

                    <!-- Breadcrumbs -->
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                      </ol>
                    </nav>
                  </div>

                  <!-- Search -->
                  <div class="input-group input-group-sm d-flex w-25 h-75">
                    <input type="text" class="form-control" aria-label="Sizing example input" placeholder="Search on this topic.." aria-describedby="inputGroup-sizing-sm">
                    <span class="input-group-text" id="inputGroup-sizing-sm">Search</span>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="card-body">
            <!-- Topic main post -->
            <TopicMainPost />

            <!-- Posts -->
            <Post v-for="post in 3" :post="post" @report="report" @reply="reply"/>
            <!-- ./ Posts-->

            <!-- Create post form -->
            <PostCreationForm :topic-id="1" :reply-id="replyId" />

            <!-- Topic footer -->
            <TopicFooter />


            <!-- Pagination -->
            <Pagination />
          </div>
        </div>

      </div>

      <!-- Sidebar content -->
      <div class="col-lg-3 ml-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
        <Sidebar />
      </div>


    </div>
  </div>

  <ReportForm :report-id="reportId" />
</template>

<script>
import Pagination from '../../components/client/Pagination.vue';
import Sidebar from '../../components/client/Sidebar.vue';
import TopicFooter from '../../components/client/TopicFooter.vue';
import TopicMainPost from '../../components/client/TopicMainPost.vue';
import Post from "../../components/client/Post.vue";
import PostCreationForm from "../../components/client/PostCreationForm.vue";
import ReportForm from "../../components/client/ReportForm.vue";
export default{
    name: "Topic",
    components: {ReportForm, PostCreationForm, Post, Sidebar, TopicFooter, Pagination, TopicMainPost },

    data(){
      return{
        replyId:null,
        reportId: null,
      }
    },

    methods:{
      reply(data){
        this.replyId = data
      },

      report(data){
        this.reportId = data
      }
    },
}
</script>

<style scoped>
.hide{
  display: none;
}

.img-card-header{
  padding: 7px;
}
</style>
