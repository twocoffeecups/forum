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
                                        <input type="text" class="form-control" aria-label="Sizing example input"
                                               placeholder="Search on this topic.."
                                               aria-describedby="inputGroup-sizing-sm">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Search</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-info mx-auto mb-3" role="alert">
                            The topic will appear on the forum after the administrator checks and approves it.
                        </div>

                        <div v-if="topic.isRejected!==null" class="alert alert-danger mx-auto mb-3" role="alert">
                            <span>Topic rejected: </span>
                            <span><b>{{ rejectedReason.reason }}</b></span>
                            <p class="my-1" v-if="rejectedReason.message">{{ rejectedReason.message }}</p>
                        </div>

                        <!-- Topic main post -->
                        <TopicMainPost :main-post="topic" :images="images" @report="report"/>

                        <div class="container ">
                            <button class="btn btn-outline-secondary fa-pull-right mx-1">{{ $t('component.post.edit') }}</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Sidebar content -->
            <div class="col-lg-3 ml-3 mb-4 mb-lg-0 px-lg-0 mt-lg-0">
                <Sidebar/>
            </div>


        </div>
    </div>
</template>

<script>
import Sidebar from '../../components/client/Sidebar.vue';
import TopicMainPost from '../../components/client/TopicMainPost.vue';
import {mapGetters} from "vuex";

export default {
    name: "UnapprovedTopic",
    components: {Sidebar, TopicMainPost},

    created() {
        this.$store.dispatch('unapprovedTopic/getTopic', this.$route.params.id);
    },

    computed: {
        ...mapGetters({
            topic: 'unapprovedTopic/getTopic',
            images: 'unapprovedTopic/getImages',
            rejectedReason: 'unapprovedTopic/getRejectedReason',
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
        }
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
