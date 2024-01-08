<template>
    <div class="row text-left">
        <div class="col-lg-5 mb-sm-0">
            <div class="form-control-lg bg-white bg-op-9 text-sm w-lg-50">
                <select v-model="orderBy" class="form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" data-toggle="select"
                        tabindex="-98">
                    <option value="asc"> First Message</option>
                    <option value="desc"> Last message</option>
                </select>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-control-lg bg-white bg-op-9 text-sm w-lg-50">
                <VueMultiselect
                    v-model="selectedTags"
                    :options="tags"
                    :multiple="true"
                    :close-on-select="false"
                    placeholder="Select whith tag"
                    label="option"
                    track-by="option"
                />
            </div>

        </div>

<!--        <div class="col-lg-3 text-lg-right">-->
<!--            <div class="form-control-lg bg-white bg-op-9 text-sm w-lg-50">-->
<!--                <select v-model="filterBy" class="form-control form-control-lg bg-white bg-op-9 text-sm w-lg-50" data-toggle="select"-->
<!--                        tabindex="-98">-->
<!--                    <option disabled> {{ $t('component.filterTopics.filterBy.filterBy') }}</option>-->
<!--                    <option value="likes"> {{ $t('component.filterTopics.filterBy.votes') }}</option>-->
<!--                    <option value="posts"> {{ $t('component.filterTopics.filterBy.replys') }}</option>-->
<!--                    <option value="views"> {{ $t('component.filterTopics.filterBy.views') }}</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->

        <div class="col-lg-3 text-lg-right d-flex justify-content-center">
            <div class="btn-group my-2">
                <button class="btn btn-danger" @click.prevent="resetFilters">Reset</button>
                <button class="btn btn-primary" @click.prevent="applyFilters" >Apply</button>

<!--                <div class="form-control-lg bg-white bg-op-9 text-sm w-lg-50">-->
<!--                    -->
<!--                </div>-->
<!--                <div class="form-control-lg bg-white bg-op-9 text-sm w-lg-50">-->
<!--                    -->
<!--                </div>-->
            </div>

        </div>
<!--        <div class="col-lg-2 text-lg-right">-->
<!--            -->
<!--        </div>-->
    </div>
</template>

<script>
import VueMultiselect from 'vue-multiselect';
import {mapMutations, mapState} from "vuex";

export default {
    name: 'FilterTopics',
    components: {VueMultiselect},
    props: ['forumId'],

    computed: {
        ...mapMutations({
            setOrderBy: 'forum/setFilterOrderBy',
            setFilterTags: 'forum/setFilterTags',
        })
    },

    mounted() {
        this.getTags();
    },

    data() {
        return {
            tags: [],
            orderBy: null,
            selectedTags: [],
            filterBy: null,
        }
    },

    watch: {
        orderBy(val){
            this.$store.commit('forum/setFilterOrderBy', val);
        },

        selectedTags(val){
            this.$store.commit('forum/setFilterTags', val)
        },

        filterBy(val){
            this.$store.commit('forum/setFilterBy', val);
        },
    },

    methods: {
        getTags() {
            axios.get('/api/client/topic/tags')
                .then(response => {
                    if(response.data){
                        this.tags = response.data.tags;
                    }
                })
        },

        applyFilters(){
            this.$store.dispatch('forum/getForum', this.forumId);
        },

        resetFilters(){
            this.$store.commit('forum/setFilterOrderBy', 'desc');
            this.$store.commit('forum/setFilterTags', [])
            this.$store.commit('forum/setFilterBy', '');
            this.selectedTags = [];
            this.$store.dispatch('forum/getForum', this.forumId);
        }
    },
}
</script>

<style src="vue-multiselect/dist/vue-multiselect.css">

</style>
