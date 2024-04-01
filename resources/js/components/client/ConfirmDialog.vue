<template>
  <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h1 class="modal-title fs-5">Warning!</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Do you want to delete your account?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="cancel">Close</button>
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="confirm">OK</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ConfirmDialog",
  props:['message'],
  emits:['confirmEmit'],


  methods:{
    cancel(){
      this.$emit('confirmationEmit', false);
    },

    confirm(){
      this.$emit('confirmationEmit', true)
    },

  }
}
</script>

<style scoped>

</style>