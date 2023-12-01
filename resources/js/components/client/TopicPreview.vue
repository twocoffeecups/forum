<template>
  <div class="preview-container hide mt-2 mb-3">

    <div class="card mb-1">
      <div class="card-header d-flex justify-content-between">
        <div class="d-flex">
          <h5 class="card-text">{{ title }}</h5> <small class="mx-2 p-1" style="font-size: 0.8em">{{ $t('component.topicHeader.byCategory') }} {{ category.title }}</small>
        </div>
        <span class="card-text d-flex">{{ $t('component.topicHeader.created') }}: 01/01/2023</span>
      </div>
    </div>


    <div class="card">
      <div class="card-body">
        <p class="card-text text-muted"><small class="text-muted">Last updated 0 mins ago</small></p>

        <p v-html="content" class="card-text">
        </p>

        <div class="card">
          <div class="card-header" @click="toggleDzImagesPreview" style="background-color: #bab5a9">
            <i>Images</i>
          </div>
          <div class="card-body overflow-y-auto overflow-x-hidden dz-template-container d-flex flex-column">

          </div>
        </div>

        <div class="d-flex justify-content-start mt-1 mx-2 mb-1">
          <div class="text-sm op-5">
            <span v-for="tag in tags" class="text-black px-1 mr-2">#{{ tag.option }}</span>
          </div>
        </div>

        <div class="mt-2 d-flex justify-content-between">
          <div class="d-flex">
            <button class="btn btn-xs text-muted has-icon"><i class="far fa-heart"></i> 0</button>
            <span class="text-muted d-inline-flex align-items-center align-middle ml-4">
                                                    <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle"> 0</span>
                                                  </span>
          </div>
          <div class="d-flex">
            <button class="btn btn-sm border-danger text-danger mx-1">{{ $t('component.post.reply') }}</button>
            <button class="btn btn-sm border-secondary text-secondary mx-1">{{ $t('component.post.edit') }}</button>
            <span class="mx-1 p-2"> <i class="far fa-bookmark" style="cursor: pointer"></i></span>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "TopicPreview",

  props:['title', 'content', 'category', 'tags'],

  methods:{
    toggleDzImagesPreview(){
      console.log('toggle previw')
      let elem = document.querySelector('.dz-template-container');
      elem.classList.add('hide');
    }
  },

}
</script>

<style scoped>
.dz-template-container img{
  max-width: 500px;
}

.hide{
  display: none;
}
</style>