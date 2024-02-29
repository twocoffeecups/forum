<template>
    <div class="container-fluid">
        <div class="card rounded-0 mb-3">
            <div class="card-header d-flex justify-content-start">
                <span class="card-text d-flex">
                    {{ $t('component.topicFooter.usersOnline') }}
                </span>
                <span v-if="users" class="card-text d-flex">
                    <span v-for="user in users"  class="mx-1">
                        <router-link :to="{name:'user.profile', params:{id:user.id}}">
                            {{ user.name }}
                        </router-link>
                    </span>
                </span>
                <span v-if="!users" class="card-text d-flex">
                    No one is reading this topic right now
                </span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'TopicFooter',
    props: ['topicId'],

    // TODO: пока не трогать
    // mounted() {
    //     Echo.join(`users.reading.topic.${this.topicId}`)
    //         .here((users) => {
    //             this.users = users;
    //         })
    //         .joining((user) => {
    //             this.users.push(user);
    //         })
    //         .leaving((user) => {
    //             this.users.splice(this.users.indexOf(user), 1)
    //         })
    //         .error((error) => {
    //             console.error(error);
    //         });
    // },
    //
    // unmounted() {
    //     Echo.leave(`users.reading.topic.${this.topicId}`);
    // },

    data() {
        return {
            users: {},
        }
    },
}
</script>

<style scoped>

</style>
