<template>
    <div v-if="isLoggedIn" class="container-fluid mt-100 mb-2">
        <div class="card rounded-0">
            <div class="card-header">
                {{ $t('component.postCreationForm.addPostForm') }}

            </div>

            <div class="card-body">
                <div class="mb-2">
                    <div class="mb-3">
                        <div v-if="reply.length!==0" style="border: 1px solid #ccc4af; border-left: 5px solid #706a5a; font-style: italic">
                            <div class="d-flex justify-content-between mb-0" style="background-color: #ccc4af">
                                <p class="mx-1">{{ $t('component.postCreationForm.replyPost')+ reply.id }}</p>
                                <span title="Cancel reply" @click="cancelReply" role="button" class="m-2"><i class="far fa-times-circle"></i></span>
                            </div>
                            <p class="m-1" v-html="reply.message"></p>
                        </div>
                    </div>

                    <div class="position-relative">
                        <div ref="emoji-button" id="emoji-container" class="d-flex position-absolute mx-auto" style="top: 0; right: 0;">
                            <span class="p-2 mx-2" role="button" id="emoji" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.3em">😄</span>
                            <div class="dropdown">
                                <div class="dropdown-menu">
                                    <Emoji @emoji_click="addEmoji" />
                                </div>
                            </div>
                        </div>
                        <QuillEditor v-model:content="post.message"
                                     toolbar="essential"
                                     contentType="html" theme="snow" id="message"/>

                    </div>
                </div>
                <div class="mb-1 d-flex justify-content-between">
                    <div class="d-flex">
                        <button type="submit" @click.prevent="createPost" class="btn btn-primary">
                            {{ $t('component.postCreationForm.addPost') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-if="!isLoggedIn" class="container-fluid mt-100 mb-2">
        <div class="card">
            <div class="card-body">
                <h4>Войдите в аккаунт или зарегистрируйтесь чтобы оставлять сообщения.</h4>
            </div>
        </div>

    </div>
</template>

<script>
import {useToast} from "vue-toastification";
import {mapGetters} from "vuex";
import Emoji from "../../components/client/Emoji.vue";
export default {
    name: "PostCreationForm",
    components: {Emoji,},
    props: ['reply', 'replyId', 'lastPage'],
    emits: ['cancelReply'],

    computed:{
        ...mapGetters({
            isLoggedIn: 'auth/isLoggedIn',
        }),
    },

    setup() {
        return {
            t$: useToast(),
        }
    },

    watch: {
        replyId(val) {
            this.post.replyId = val;
        },

        '$route.params.id': {
            immediate: true,
            handler() {
                this.post.topicId = this.$route.params.id;
            },
        },
    },

    data() {
        return {
            post: {
                topicId: this.$route.params.id,
                replyId: this.replyId,
                message: null,
            },
        }
    },

    methods: {
        createPost() {
            this.$store.dispatch('createPost', this.post);
            this.post.message = null;
            this.post.replyId = null;
        },

        cancelReply() {
            this.$emit('cancelReply');
        },

        addEmoji(emoji){
            this.post.message += emoji;
        },
    }
}
</script>

<style src="quill-emoji/dist/quill-emoji.css">

</style>
