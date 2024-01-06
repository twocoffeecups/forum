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
                        <span v-if="topicTags!==0" v-for="tag in topicTags"
                              class="bg-primary m-1 p-1 rounded-3">{{ tag.name }}</span>
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
                        <span @click.prevent="deleteForm=!deleteForm" role="button" class="text-danger mx-2"
                              title="Delete">
                            <i class="fas fa-trash"></i>
                        </span>
                        <router-link :to="{name:'topic.unapproved', params:{id: this.$route.params.id}}" class="btn btn-primary mx-1">
                            Show
                        </router-link>
                    </dd>
                    <dd v-if="deleteForm" class="col-sm-8 offset-sm-4 d-flex flex-row">
                        <textarea v-model="deleteReason" class="form-control mx-1"
                                  placeholder="Reason for deletion..."></textarea>
                        <div>
                            <button @click.prevent="deleteTopic" class="btn btn-danger bg-gradient mx-1">Delete</button>
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="row">
        <div v-if="!topic.status" class="card my-3">
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
                    <div v-if="!topicStatus && topic.isRejected===null" class="row">
                        <dt class="col-sm-4">Reason</dt>
                        <dd class="col-sm-8">
                            <select v-model="selectedReasonId" class="form-select">
                                <option v-for="type in rejectTypes" :value="type.id">{{ type.title }}</option>
                            </select>
                        </dd>
                        <dt class="col-sm-4">Message</dt>
                        <dd class="col-sm-8">
                            <textarea v-model="message" class="form-control"></textarea>
                        </dd>
                        <dt>
                            <button @click.prevent="rejectTopic" class="btn btn-danger">Reject</button>
                        </dt>
                    </div>
                    <!--                    <dt v-if="!topicStatus" class="col-sm-4">Reason</dt>-->
                    <!--                    <dd v-if="!topicStatus" class="col-sm-8">-->
                    <!--                        <select v-model="selectedReasonId" class="form-select">-->
                    <!--                            <option v-for="type in rejectTypes" :value="type.id">{{ type.title }}</option>-->
                    <!--                        </select>-->
                    <!--                    </dd>-->
                    <!--                    <dt v-if="!topicStatus" class="col-sm-4">Message</dt>-->
                    <!--                    <dd v-if="!topicStatus" class="col-sm-8">-->
                    <!--                        <textarea v-model="message" class="form-control"></textarea>-->
                    <!--                    </dd>-->
                    <dt v-if="topicStatus">
                        <button @click.prevent="resolveTopic" class="btn btn-success">Resolve</button>
                    </dt>
                </dl>
            </div>
        </div>
    </div>
</template>

<script>
import {useToast} from "vue-toastification";
import {mapGetters} from "vuex";
import api from "../../api/api";

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
            selectedReasonId: null,
            rejectTypes: [],
            message: null,
        }
    },

    mounted() {
        this.$store.dispatch('adminTopic/getTopic', this.$route.params.id);
        this.getRejectTypes();
    },

    methods: {
        deleteTopic() {
            // console.log("Topic deleted, reason:", this.deleteReason)
            const data = new FormData();
            data.append('reason', this.deleteReason);
            data.append('_method', 'delete');
            this.$store.dispatch('adminTopic/deleteTopic', [this.$route.params.id, data]);
        },

        getRejectTypes() {
            api.get('/api/admin/topic-reject-type')
                .then(response => {
                    this.rejectTypes = response.data.rejectTypes;
                })
        },

        rejectTopic() {
            const data = new FormData();
            data.append('reasonId', this.selectedReasonId);
            data.append('message', this.message)
            //console.log(data);
            this.$store.dispatch('adminTopic/rejectTopic', [this.$route.params.id, data]);
        },

        resolveTopic() {
            this.$store.dispatch('adminTopic/resolveTopic', this.$route.params.id);
        }
    }
}
</script>

<style>

</style>
