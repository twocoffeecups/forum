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
                                <h4>Forum title</h4>
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
                        <div class="card mt-2 mb-2">
                            <ForumItem v-for="childForum in 6"/>
                        </div>
                        <!-- End child -->

                        <!-- Topic -->
                        <div class="card m-sm-0 mt-1 mb-2">
                            <div class="card-header">
                                <div class="row">
                                    <div class="d-flex justify-content-between">
                                        <h4>Forums</h4>
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
                                <template v-for="topic in 20">
                                    <Topic/>
                                </template>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <Pagination/>
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

    data() {
        return {
            categories: [
                {
                    id: 1,
                    title: 'Lorem ipsum dolor sit amet',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
                    icon: 'fas fa-shield-alt',
                    views: 1216,
                    topics: 238,
                    posts: 140,
                },
                {
                    id: 1,
                    title: 'Lorem ipsum dolor sit amet',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
                    icon: 'fa fa-bolt',
                    views: 1216,
                    topics: 238,
                    posts: 140,
                },
                {
                    id: 1,
                    title: 'Lorem ipsum dolor sit amet',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
                    icon: 'fa fa-calendar',
                    views: 1216,
                    topics: 238,
                    posts: 140,
                },
                {
                    id: 1,
                    title: 'Lorem ipsum dolor sit amet',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
                    icon: 'fa fa-star',
                    views: 1216,
                    topics: 238,
                    posts: 140,
                },
                {
                    id: 1,
                    title: 'Lorem ipsum dolor sit amet',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
                    icon: 'fa fa-bomb',
                    views: 1216,
                    topics: 238,
                    posts: 140,
                },
                {
                    id: 1,
                    title: 'Lorem ipsum dolor sit amet',
                    description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.',
                    icon: 'fa fa-ambulance',
                    views: 1216,
                    topics: 238,
                    posts: 140,
                },
            ],
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
