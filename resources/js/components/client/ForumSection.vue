<template>
  <div class="container" v-for="generalForum in 3">
    <div class="row">
      <div class="col-12">
        <div class="card mt-2 mb-2">
          <div class="card-header d-flex justify-content-between">
            <h3>General subjects</h3>
<!--            <span class="d-flex align-items-center">{{ $t('view.main.totalPosts') }}: 320,800</span>-->
          </div>

          <ForumItem v-for="childForum in 6" />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ForumItem from "./ForumItem.vue";
export default {
  name: "ForumSection",
  components: {ForumItem},

  props:['forumSections'],
}
</script>

<style scoped>

</style>