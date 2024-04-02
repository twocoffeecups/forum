<template>

    <div class="container">
        <div class="row">
            <!-- Main content -->
            <div class="col-lg-9 mb-3">
                <div class="card rounded-0">
                    <div class="card-header">
                        <!-- Forum head -->
                        <div class="">
                            <div class="row">
                                <h4>{{ forum.name }}</h4>
                            </div>

                            <div class="row">
                                <!-- Breadcrumbs -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Data</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">


                        <!-- Child categories -->
                        <div v-if="childrenForums!= 0" class="card rounded-0 my-2">
                            <div class="card-header">
                                <h5 class="fw-bold">Children forums</h5>
                            </div>
                            <ForumItem v-if="childrenForums" v-for="childForum in childrenForums" :forum="childForum"/>
                        </div>
                        <!-- End child -->

                        <!-- Administration topics -->
                        <div v-if="administrationTopics!=0" class="card rounded-0 my-2">
                            <div class="card-header p-3">
                                <h5 class="fw-bold">Administration's topics</h5>
                            </div>
                            <div class="card-body p-0 bg-body-tertiary bg-gradient">
                                <AdministrationsTopic v-if="administrationTopics" v-for="administrationTopic in administrationTopics" :topic="administrationTopic" />
                            </div>
                        </div>

                        <!-- Topic -->
                        <div v-if="totalTopics !== 0" class="card rounded-0 m-sm-0 mt-1 mb-2">
                            <div class="card-header">
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="fw-bold">Topics</h5>
                                        <div class="d-flex">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="filter-btn accordion-button collapsed p-2" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                                    {{ $t('view.forum.filters') }}
                                                </button>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                     aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <FilterTopics :forum-id="forum.id"/>
                                    </div>
                                </div>

                            </div>

                            <!-- Topics -->
                            <div class="card-body p-0 bg-body-tertiary bg-gradient">
                                <template v-for="topic in topics">
                                    <Topic :topic="topic"/>
                                </template>

                            </div>

                            <div v-if="topics.length === 0 && totalTopics !== 0" class="text-center my-2 p-3">
                                <h4>Nothing was found for your request.</h4>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <Pagination v-if="totalPages > 1"
                                    @selectPageEmit="selectPage"
                                    :total-pages="totalPages"
                                    :links="paginate.links"
                                    :forum-id="this.$route.params.id"
                                    :current-page="paginate.current_page"
                                    :last-page="paginate.last_page" />

                        <div class="m-sm-0 mt-1 mb-2">
                            <div class="mx-3 p-1 text-center" v-if="totalTopics === 0">
                                <h4>There is not a single topics on this forum. Create first!</h4>
                            </div>
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
import FilterTopics from '../../components/client/FilterTopics.vue';
import Sidebar from '../../components/client/Sidebar.vue';
import Topic from '../../components/client/Topic.vue';
import Pagination from "../../components/client/Pagination.vue";
import ForumItem from "../../components/client/ForumItem.vue";
import {mapGetters} from "vuex";
import AdministrationsTopic from "../../components/client/AdministrationsTopic.vue";

export default {
    name: "Forum",
    components: {AdministrationsTopic, Sidebar, FilterTopics, Topic, Pagination, ForumItem},

    computed: {
        ...mapGetters({
            forum: 'forum/getForum',
            childrenForums: 'forum/getChildrenForums',
            topics: 'forumTopics/getTopics',
            totalTopics: 'forum/getTotalTopics',
            totalPages: 'forumTopics/getTotalPages',
            paginate: 'forumTopics/getPaginate',
            administrationTopics: 'forum/getAdministrationsTopics',
        }),
    },

    // mounted() {
    //     this.$store.dispatch('forum/getForum', this.$route.params.id);
    //     this.$store.dispatch('forumTopics/getTopics', this.$route.params.id);
    // },

    watch: {
        '$route.params.id': {
            immediate: true,
            handler() {
                this.$store.dispatch('forum/getForum', this.$route.params.id);
                this.$store.dispatch('forumTopics/getTopics', this.$route.params.id);
            },
        },
    },

    methods: {
        selectPage(page){
            this.$store.dispatch('forumTopics/getTopics', [this.$route.params.id, page]);
        }
    }
}
</script>

<style scoped>
.card-header{
    background-color: white;
}
li {
    color: white;
}

.filter-btn {
    border: 2px solid #0a53be;
    border-radius: 7px;
    color: #0a53be;
}

.filter-btn:hover {
    background-color: #0a53be;
    color: #ffffff;
}


.forum-item {
    margin: 10px 0;
    padding: 10px 0 20px;

}

.forum-nav-link {

    font-weight: 500;
}

.forum-nav-link:hover {
    color: black;
}
</style>
