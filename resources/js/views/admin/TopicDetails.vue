<template>
    <div class="row">
        <div class="card my-3">
            <div class="card-header">
                <h4>Topic details</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Title</dt>
                    <dd class="col-sm-8">
                        {{ topic.title }}
                    </dd>
                    <dt class="col-sm-4">Author</dt>
                    <dd class="col-sm-8">
                        {{ topic.author }}
                    </dd>
                    <dt class="col-sm-4">Tags</dt>
                    <dd class="col-sm-8">
                        <span v-if="topicTags!==0" v-for="tag in topicTags" class="bg-primary m-1 p-1 rounded-3">{{ tag.name }}</span>
                    </dd>
                    <dt class="col-sm-4">Posts</dt>
                    <dd class="col-sm-8">
                        <span>{{ topic.posts }}</span>
                    </dd>
                    <dt class="col-sm-4">Views</dt>
                    <dd class="col-sm-8">
                        <span>{{ topic.views }}</span>
                    </dd>
                    <dt class="col-sm-4">Created AT</dt>
                    <dd class="col-sm-8">{{ topic.created_at }}</dd>
                    <dt class="col-sm-4">Actions</dt>
                    <dd class="col-sm-8">
                        <span @click.prevent="deleteForm=!deleteForm" role="button" class="text-danger mx-2" title="Delete">
                            <i class="fas fa-trash"></i>
                        </span>
                    </dd>
                    <dd v-if="deleteForm" class="col-sm-8 offset-sm-4 d-flex flex-row">
                        <textarea v-model="deleteReason" class="form-control mx-1" placeholder="Reason for deletion..."></textarea>
                        <div>
                            <button @click.prevent="deleteTopic" class="btn btn-danger bg-gradient mx-1">Delete</button>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card my-3">
            <div class="card-header">
                <h4>Published / Unpublished</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-4">Status</dt>
                    <dd class="col-sm-8">
                        {{ topic.status }}
                    </dd>
                    <dt class="col-sm-4">Action</dt>
                    <dd class="col-sm-8">
                        <div class="btn-group  btn-group-sm" role="group"
                             aria-label="Basic radio toggle button group"
                             @change.prevent="topicStatus=!topicStatus">
                            <input type="radio" class="btn-check" :name="topic.id+'isPublished'"
                                   :id="topic.id+'hide'" value="false" autocomplete="off"
                                   :checked="topic.status !== true">
                            <label class="btn btn-outline-danger" :for="topic.id+'hide'">Reject
                                Publication</label>

                            <input type="radio" class="btn-check" :name="topic.id+'isPublished'"
                                   :id="topic.id+'published'" value="true" autocomplete="off"
                                   :checked="topic.status === true">
                            <label class="btn btn-outline-success" :for="topic.id+'published'">Allow
                                Publication</label>
                        </div>
                    </dd>
                    <dt v-if="!topicStatus" class="col-sm-4">Message</dt>
                    <dd v-if="!topicStatus" class="col-sm-8">
                        <textarea class="form-control"></textarea>
                    </dd>
                    <dt>
                        <button class="btn btn-primary">Save</button>
                    </dt>
                </dl>
            </div>
        </div>
    </div>
</template>

<script>
import {useToast} from "vue-toastification";
import {mapGetters} from "vuex";

export default {
    name: "ForumDetails",

    computed: {
        ...mapGetters({
            topic: 'adminTopic/getTopic',
            topicTags: 'adminTopic/getTopicTags',
        }),
    },

    setup() {
        return {
            t$: useToast(),
        }
    },

    data() {
        return {
            topicStatus: false,
            deleteForm: false,
            deleteReason: null,
        }
    },

    mounted() {
        this.$store.dispatch('adminTopic/getTopic', this.$route.params.id);
    },

    methods: {
        deleteTopic(){
            console.log("Topic deleted, reason:", this.deleteReason)
            this.$store.dispatch('adminTopic/deleteTopic', [this.$route.params.id, this.deleteReason]);
        }
    }
}
</script>

<style>

</style>
