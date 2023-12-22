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
                        <QuillEditor v-model:content="post.message" toolbar="essential" contentType="html" id="description"
                                     theme="snow"/>
                    </div>
                </div>
                <div class="mb-1">
                    <button type="submit" @click.prevent="creationPost" class="btn btn-primary">
                        {{ $t('component.postCreationForm.addPost') }}
                    </button>
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

export default {
    name: "PostCreationForm",
    props: ['reply', 'replyId', 'topicId'],
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
        }
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
        creationPost() {
            this.$store.dispatch('createPost', this.post);
        },

        cancelReply() {
            this.$emit('cancelReply');
        }
    }
}
</script>

<style scoped>

</style>
