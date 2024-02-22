<template>
    <div v-if="isLoggedIn" class="container-fluid mt-100 mb-2">
        <div class="card">
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

                    <div>
                        <QuillEditor v-model:content="post.message"
                                     toolbar="essential"
                                     contentType="html" id="message"
                                     theme="snow"/>
                    </div>


                    <div class="container" style="position:relative;">
                        <h2>Editor</h2>
                        <div id="quill-editor" style="max-height: 300px;"></div>
                    </div>
                </div>
                <div class="mb-1 d-flex justify-content-between">
                    <div class="d-flex">
                        <button type="submit" @click.prevent="createPost" class="btn btn-primary">
                            {{ $t('component.postCreationForm.addPost') }}
                        </button>
                    </div>

                    <div id="emoji-container" class="d-flex">
                        <span class="p-2 mx-2" role="button" id="emoji" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 1.3em">😄 Add Emoji</span>
                        <div class="dropdown">
                            <div class="dropdown-menu">
                                <Emoji @emoji_click="addEmoji" />
                            </div>
                        </div>
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
import {Quill} from "@vueup/vue-quill";
export default {
    name: "PostCreationForm",
    components: {Emoji,},
    props: ['reply', 'replyId'],
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
                message: '',
            },
        }
    },

    methods: {
        createPost() {
            //console.log(this.post)
            this.$store.dispatch('createPost', this.post);
        },

        cancelReply() {
            this.$emit('cancelReply');
        },

        addEmoji(emoji){
            console.log('click on emoji!', emoji);
            this.post.message += emoji;
        },
    }
}
</script>

<style scoped>

</style>
