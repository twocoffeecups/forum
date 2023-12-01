<template>
  <div class="d-flex justify-content-center mt-3">
    <router-link :to="{name:'topic.create'}" class="btn btn-block btn-success rounded-0 py-4 mb-3 bg-op-6 roboto-bold">{{ $t('component.createTopic.btn') }}</router-link>
  </div>
</template>

<script>
export default {
  name: "CreateTopic"
}
</script>

<style scoped>

</style>