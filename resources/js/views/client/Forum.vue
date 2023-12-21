<template>

    <div class="container">
        <div class="row">
            <!-- Main content -->
            <div class="col-lg-9 mb-3">


                <div class="card">
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
                        <div v-if="childrenForums.length !== 0" class="card mt-2 mb-2">
                            <ForumItem v-for="childForum in childrenForums" :forum="childForum"/>
                        </div>
                        <!-- End child -->

                        <!-- Topic -->
                        <div v-if="topics.length !== 0" class="card m-sm-0 mt-1 mb-2">
                            <div class="card-header">
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <h4>Topics</h4>
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
                                        <FilterTopics/>
                                    </div>
                                </div>

                            </div>

                            <!-- Topics -->
                            <div class="card-body p-0 bg-body-tertiary bg-gradient">
                                <template v-for="topic in topics">
                                    <Topic :topic="topic" />
                                </template>

                            </div>
                        </div>

                        <!-- Pagination -->
                        <Pagination v-if="childrenForums.length !==0" />

                        <div class="m-sm-0 mt-1 mb-2">
                            <div class="mx-3 p-1 text-center" v-if="topics.length === 0">
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

export default {
    name: "Forum",
    components: {Sidebar, FilterTopics, Topic, Pagination, ForumItem},

    created() {
        this.getForums(this.$route.params.id);
    },

    data() {
        return {
            forum: [],
            childrenForums: [],
            topics: [],
        }
    },

    watch: {
        '$route.params.id': {
            immediate: true,
            handler(){
                this.getForums(this.$route.params.id);
            },
        },
    },

    methods: {
        getForums(id){
            axios.get(`/api/client/forum/${id}`)
                .then(res => {
                    console.log(res.data);
                    this.forum = res.data.forum
                    this.childrenForums = res.data.forum.children;
                    this.topics = res.data.forum.topics;
                })
                .catch(error => {
                    console.log(error);
                })

        }
    }

}
</script>

<style scoped>

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
