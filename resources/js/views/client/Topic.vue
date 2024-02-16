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
                                    <!-- TODO: Сделать поиск по теме -->
<!--                                    <div class="input-group input-group-sm d-flex w-25 h-75">-->
<!--                                        <input type="text" class="form-control" aria-label="Sizing example input"-->
<!--                                               placeholder="Search on this topic.."-->
<!--                                               aria-describedby="inputGroup-sizing-sm">-->
<!--                                        <span class="input-group-text" id="inputGroup-sizing-sm">Search</span>-->
<!--                                    </div>-->
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <!-- Topic main post -->
                        <TopicMainPost :main-post="topic" :images="images" @report="report"/>

                        <!-- Posts -->
                        <Post v-for="post in posts" :post="post" @report="report" @reply="reply"/>
                        <!-- ./ Posts-->

                        <!-- Pagination -->
                        <Pagination v-if="paginate.last_page > 1"
                                    @selectPageEmit="selectPage"
                                    :total-pages="totalPages"
                                    :links="paginate.links"
                                    :forum-id="this.$route.params.id"
                                    :current-page="paginate.current_page"
                                    :last-page="paginate.last_page" />

                        <!-- Create post form -->
                        <PostCreationForm :reply="replyPost" :reply-id="replyPost.id" @cancelReply="cancelReply"/>

                        <!-- Topic footer -->
                        <TopicFooter v-if="isLoggedIn" :topic-id="this.$route.params.id" />


                    </div>
                </div>

            </div>

            <!-- Sidebar content -->
            <div class="col-lg-3 ml-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
                <Sidebar/>
            </div>


        </div>
    </div>

    <ReportForm :report-id="reportDetail.id" :type="reportDetail.type" :user-id="reportDetail.userId"/>
</template>

<script>
import Pagination from '../../components/client/Pagination.vue';
import Sidebar from '../../components/client/Sidebar.vue';
import TopicFooter from '../../components/client/TopicFooter.vue';
import TopicMainPost from '../../components/client/TopicMainPost.vue';
import Post from "../../components/client/Post.vue";
import PostCreationForm from "../../components/client/PostCreationForm.vue";
import ReportForm from "../../components/client/ReportForm.vue";
import {mapGetters} from "vuex";

export default {
    name: "Topic",
    components: {ReportForm, PostCreationForm, Post, Sidebar, TopicFooter, Pagination, TopicMainPost},

    created() {
        this.$store.dispatch('topic/getTopic', this.$route.params.id);
    },

    mounted() {
        this.$store.dispatch('topic/getTopicPosts', this.$route.params.id);
    },

    computed: {
        ...mapGetters({
            topic: 'topic/getTopic',
            posts: 'topic/getPosts',
            images: 'topic/getImages',
            isLoggedIn: 'auth/isLoggedIn',
            paginate: 'topic/getPaginate',
        }),
    },

    data() {
        return {
            replyPost: [],
            reportId: null,
            reportDetail: [],
            author: [],
        }
    },

    watch: {
        '$route.params.id': {
            immediate: true,
            handler() {
                this.$store.dispatch('topic/getTopic', this.$route.params.id);
            },
        },
    },

    methods: {
        reply(data) {
            this.replyPost = data
        },
        report(data) {
            this.reportId = data.id
            this.reportDetail = data;
        },
        cancelReply() {
            this.replyPost = [];
        },

        selectPage(page){
            this.$store.dispatch('topic/getTopicPosts', [this.$route.params.id, page]);
        },
    },
}
</script>

<style scoped>
.hide {
    display: none;
}

.img-card-header {
    padding: 7px;
}
</style>
