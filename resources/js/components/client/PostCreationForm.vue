<template>
    <div v-if="isLoggedIn" class="container-fluid mt-100 mb-2">
        <div class="card">
            <div class="card-header">
                {{ $t('component.postCreationForm.addPostForm') }}
            </div>

            <div class="card-body">
                <div class="mb-2">
                    <div class="mb-3">
                        <span v-if="replyId" class="form-label">{{
                                $t('component.postCreationForm.replyPost')
                            }} {{ replyId }}</span>
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
    props: ['replyId', 'topicId'],

    computed:{
        ...mapGetters({
            isLoggedIn: 'isLoggedIn',
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
                topicId: this.topicId,
                replyId: this.replyId,
                message: null,

            },
            user: true,
        }
    },

    methods: {
        creationPost() {
            this.$store.dispatch('createPost', this.post);
        }
    }
}
</script>

<style scoped>

</style>
