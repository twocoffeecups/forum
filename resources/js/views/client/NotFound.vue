<template>
    <div class="container-fluid container-lg container-md">
        <div class="row">

            <div class="col-lg-9 col-md-12 col-sm-12 mb-3">

                <!-- Main content -->
                <div class="card rounded-0" style="border-radius: 1rem;">

                    <div class="card-body text-center">
                        <h4 class="mx-auto my-5">Topic not found</h4>
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
    components: {Sidebar,},
}
</script>

<style scoped>

</style>
