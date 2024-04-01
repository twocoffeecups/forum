<template>
    <div class="row mb-3">
        <div class="col-12">
            <div class="card rounded-0" style="border-top: 5px solid #0c63e4">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs" id="topic-details-nav-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-0 active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane" type="button" role="tab" aria-controls="details-tab-pane" aria-selected="true">Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-0" id="actions-tab" data-bs-toggle="tab" data-bs-target="#actions-tab-pane" type="button" role="tab" aria-controls="actions-tab-pane" aria-selected="false">Actions</button>
                        </li>
                        <li v-if="checkHasPermissions([AccessPermissions.CAN_RESOLVE_TOPIC, AccessPermissions.CAN_REJECT_TOPIC])" class="nav-item" role="presentation">
                            <button class="nav-link rounded-0" id="published-tab" data-bs-toggle="tab" data-bs-target="#published-tab-pane" type="button" role="tab" aria-controls="published-tab-pane" aria-selected="false">Published</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="topic-details-tab">
                        <!-- Details -->
                        <div class="tab-pane fade show active" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab" tabindex="0">
                            <div class="container">
                                <div class="row align-items-start mb-2">
                                    <div class="col-5">
                                        <b>Title</b>
                                    </div>
                                    <div class="col-7">
                                        {{ topic.title }}
                                    </div>
                                </div>
                                <div class="row align-items-start mb-2">
                                    <div class="col-5">
                                        <b>Author</b>
                                    </div>
                                    <div class="col-7">
                                        {{ topic.author }}
                                    </div>
                                </div>
                                <div class="row align-items-start mb-2">
                                    <div class="col-5">
                                        <b>Tags</b>
                                    </div>
                                    <div class="col-7">
                                        <div class="flex-row">
                                <span v-if="topicTags!==0" v-for="tag in topicTags" class="badge bg-primary m-1 p-1">
                                    {{ tag.name }}
                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-start mb-2">
                                    <div class="col-5">
                                        <b>Posts</b>
                                    </div>
                                    <div class="col-7">
                                        {{ topic.posts }}
                                    </div>
                                </div>
                                <div class="row align-items-start mb-2">
                                    <div class="col-5">
                                        <b>Views</b>
                                    </div>
                                    <div class="col-7">
                                        {{ topic.views }}
                                    </div>
                                </div>
                                <div class="row align-items-start mb-2">
                                    <div class="col-5">
                                        <b>Created</b>
                                    </div>
                                    <div class="col-7">
                                        {{ topic.created_at }}
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Actions -->
                        <div class="tab-pane fade" id="actions-tab-pane" role="tabpanel" aria-labelledby="actions-tab" tabindex="0">
                            <div class="container">
                                <div class="row align-items-start mb-2">
                                    <div class="row align-items-start mb-2">
                                        <div class="col-5">
                                            <b>Show</b>
                                        </div>
                                        <div class="col-7">
                                            <a :href="`/topic/${this.$route.params.id}`" class="btn btn-primary mx-2">
                                                Show
                                            </a>
                                        </div>
                                    </div>
                                    <div v-if="checkHasPermissions([AccessPermissions.CAN_DELETE_TOPIC])" class="col-5">
                                        <b>Delete</b>
                                    </div>
                                    <div v-if="checkHasPermissions([AccessPermissions.CAN_DELETE_TOPIC])" class="col-7">
                                        <div class="d-flex flex-row">
                                            <div class="col">
                                            <textarea v-model="deleteReason" class="form-control my-1"
                                                      placeholder="Reason for deletion...">
                                            </textarea>

                                                <button @click.prevent="deleteTopic" class="btn btn-danger bg-gradient mx-1">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Published | Unpublished -->
                        <div v-if="checkHasPermissions([AccessPermissions.CAN_RESOLVE_TOPIC, AccessPermissions.CAN_REJECT_TOPIC])" class="tab-pane fade" id="published-tab-pane" role="tabpanel" aria-labelledby="actions-tab" tabindex="0">
                            <div class="card-body">
                                <div class="row align-items-start mb-2">
                                    <div class="col-5">
                                        <b>Status</b>
                                    </div>
                                    <div class="col-7">
                                        {{ topic.status ? 'Published' : 'Unpublished' }}
                                    </div>
                                </div>
                                <div class="row align-items-start mb-2">
                                    <div class="col-5">
                                        <b>Action</b>
                                    </div>
                                    <div class="col-7">
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
                                    </div>
                                </div>
                                <div v-if="!topicStatus && topic.isRejected===null" class="row align-items-end mb-3">
                                    <div class="col-5">
                                        <b>Reason</b>
                                    </div>
                                    <div class="col-7">
                                        <select v-model="selectedReasonId" class="form-select">
                                            <option v-for="type in rejectTypes" :value="type.id">{{ type.title }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div v-if="!topicStatus && topic.isRejected===null" class="row align-items-end mb-3">
                                    <div class="col-5 mb-auto">
                                        <b>Message</b>
                                    </div>
                                    <div class="col-7">
                                        <div class="d-flex flex-row">
                                            <div class="col">
                                                <textarea v-model="message" class="form-control"></textarea>
                                                <button @click.prevent="rejectTopic" class="btn btn-danger my-2">Reject</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="topicStatus" class="row align-items-end mb-2">
                                    <div class="col-5">
                                        <b></b>
                                    </div>
                                    <div class="col-7">
                                        <button @click.prevent="resolveTopic" class="btn btn-success">Resolve</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import api from "../../api/api";
import {checkHasPermissions} from "../../access/service";
import AccessPermissions from "../../access/permissions";

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
            checkHasPermissions,
            AccessPermissions,
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
            const data = new FormData();
            data.append('reason', this.deleteReason);
            data.append('_method', 'delete');
            this.$store.dispatch('adminTopic/deleteTopic', [this.$route.params.id, data]);
        },

        getRejectTypes() {
            api.get('/api/admin/topic/reject-types')
                .then(response => {
                    console.log(response.data.data)
                    this.rejectTypes = response.data.rejectTypes;
                })
        },

        rejectTopic() {
            const data = new FormData();
            data.append('reasonId', this.selectedReasonId);
            data.append('message', this.message)
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
