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
                                <h4>Search page</h4>
                            </div>

                            <div class="row">
                                <!-- Breadcrumbs -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item"><a href="#">Search</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mt-1 mb-3">
                            <div class="d-flex">
                                <input @keydown.enter="startSearch" type="search" class="form-control" placeholder="Search" v-model="search" />
                                <button class="btn btn-primary mx-2" @click.prevent="startSearch">Search</button>
                            </div>

                        </div>

                        <div v-if="results.length!==0">
                            <h4 class="mx-1">Найденно результатов: {{ totalFound }}</h4>
                            <template v-for="result in results">
                                <TopicMainPost v-if="result.type==='topic'" :main-post="result" :images="result.images" />
                                <Post v-if="result.type==='post'" :post="result" />
                            </template>
                        </div>


                        <div v-if="results.length===0 || totalFound===0" class="m-sm-0 mt-1 mb-2">
                            <div class="mx-3 p-1 text-center">
                                <h4>Not Found.</h4>
                            </div>
                        </div>

                        <!-- Paginate -->
                        <Pagination v-if="paginate.total_page > 1"
                                    @selectPageEmit="selectPage"
                                    :total-pages="paginate.total_page"
                                    :current-page="paginate.current_page"
                                    :last-page="paginate.total_page" />
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
import Pagination from "../../components/client/Pagination.vue";
import Sidebar from "../../components/client/Sidebar.vue";
import {mapGetters} from "vuex";
import Post from "../../components/client/Post.vue";
import TopicMainPost from "../../components/client/TopicMainPost.vue";
export default {
    name: "Search",
    components: {TopicMainPost, Sidebar, Pagination, Post},

    computed: {
        ...mapGetters({
            results: 'search/getResults',
            paginate: 'search/getPaginate',
            totalFound: 'search/getTotalFound',
        }),
    },

    data() {
        return {
            search: this.$route.params.search ?? null,
            currentPage: 1,
        }
    },

    watch: {
        '$route.params.search': {
            immediate: true,
            handler() {
                this.search = this.$route.params.search;
            },
        },
    },

    methods: {
        startSearch() {
            this.$store.dispatch('search/search', [this.search!=='' ? this.search : this.$route.params.search])
        },

        selectPage(page){
            console.log("SEARCH:", typeof this.search)
            this.$store.dispatch('search/search', [this.search!=='' ? this.search : this.$route.params.search, page]);
        }
    }
}
</script>

<style scoped>

</style>
