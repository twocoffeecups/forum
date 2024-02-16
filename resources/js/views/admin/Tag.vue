<template>
    <div class="row mb-3">
        <div class="col-md-8 mb-3">
            <!-- Table card -->
            <div class="card" style="border-top: 5px solid green">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4><i class="fas fa-tags"></i> Tags list</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive mb-1">
                        <div v-if="tags!==0"
                             class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
                            <div v-if="tags.length > 10" class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
                                    <span class="form-text">
                                      Show
                                    </span>
                                <select v-model="entriesOnPage" class="form-select form-select-sm mx-2" aria-label="Select entries">
                                    <option value="10" selected>10</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                </select>
                                <span class="form-text">entries</span>
                            </div>
                            <div class="d-flex mx-2 my-2">
                                <label class="form-text mx-1">Search: </label>
                                <input type="search" class="form-control" id="search" style="max-height: 20px;"/>
                            </div>
                        </div>

                        <!-- Table -->
                        <table v-if="tags!==0" class="table table-striped table-hover table-bordered">
                            <thead class="table-primary">
                            <tr></tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Author</th>
                                <th scope="col">Topics</th>
                                <th scope="col">Created date</th>
                                <th scope="col">Visibility</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="tag in tags">
                                <th scope="row">{{ tag.id }}</th>
                                <td contenteditable @focusout.prevent="renameTag($event, tag.id, tag.name)">{{ tag.name }}</td>
                                <td>
                                    {{ tag.author }}
                                </td>
                                <td>{{ tag.topics }}</td>
                                <td>{{ tag.created_at }}</td>
                                <td>
                                    <div class="btn-group  btn-group-sm" role="group"
                                         aria-label="Basic radio toggle button group"
                                         @change.prevent="changeVisibility($event, tag.id)">
                                        <input type="radio" class="btn-check" :name="tag.id+'isPublished'"
                                               :id="tag.id+'hide'" value="false" autocomplete="off"
                                               :checked="tag.status != true">
                                        <label class="btn btn-outline-secondary" :for="tag.id+'hide'">Hide</label>

                                        <input type="radio" class="btn-check" :name="tag.id+'isPublished'"
                                               :id="tag.id+'published'" value="true" autocomplete="off"
                                               :checked="tag.status == true">
                                        <label class="btn btn-outline-success" :for="tag.id+'published'">Publish</label>
                                    </div>

                                </td>
                                <td>
                                    <button @click="deleteTag(tag.id)" role="button" class="btn btn-danger bg-gradient mx-2"
                                            title="Edit"> Delete
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <TablePagination
                            @selectPageEmit="selectPage"
                            :total-entries="paginate.total"
                            :total-pages="paginate.last_page"
                            :links="paginate.links"
                            :current-page="paginate.current_page"
                            :last-page="paginate.last_page" />

                        <div v-if="tags===0" class="text-center mx-1">
                            <h4>You haven't rejected tags.</h4>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <CreateTagCard />
        </div>
    </div>

</template>

<script>
import {mapGetters} from "vuex";
import TablePagination from "../../components/admin/TablePagination.vue";
import CreateTagCard from "../../components/admin/CreateTagCard.vue";
export default {
    name: "Tag",
    components: {CreateTagCard, TablePagination, },

    computed: {
        ...mapGetters({
            tags: 'tag/getTags',
            paginate: 'tag/getPaginate',
        })
    },

    watch: {
        entriesOnPage(val){
            this.$store.commit('tag/setEntriesOnPage', val);
            this.$store.dispatch('tag/getTags')
        }
    },

    mounted() {
        this.getTags();
    },

    data() {
        return {
            visibility: null,
            entriesOnPage: 10,
        }
    },

    methods: {
        getTags() {
            this.$store.dispatch('tag/getTags');
        },

        renameTag(event, id, tagName){
            let name = event.target.innerText;
            if (name == tagName) return;
            if (name.length < 3) {
                this.t$.error("Min length 3.");
                return;
            }
            this.$store.dispatch('tag/renameTag', [id, name]);
        },

        deleteTag(id) {
            this.$store.dispatch('tag/deleteTag', id);
        },

        changeVisibility(event, id) {
            let value = event.target.value;
            this.$store.dispatch('tag/changeVisibility', [id, value]);
        },

        selectPage(page){
            this.$store.dispatch('tag/getTags', page)
        }
    }
}
</script>

<style scoped>

</style>
