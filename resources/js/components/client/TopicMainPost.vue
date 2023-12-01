<template>
    <TopicMainPostHeader topicTitle="Topic title" categoryTitle="News"/>

    <div class="container-fluid mt-100 mb-2">
        <div class="card">
          <div class="row g-0">
              <div class="col-md-3">
                <div class="card-header h-100">
                  <div class="media flex-wrap w-100 align-items-center"> <img src="https://i0.wp.com/www.celebrity-cutouts.com/wp-content/uploads/2018/11/todd-howard-smile-celebrity-mask.png?resize=450%2C450&ssl=1" width="64" class="d-block ui-w-40 rounded-circle" alt="">
                    <div class="media-body ml-3"> <a href="javascript:void(0)" data-abc="true">Tod Howard</a>
                      <div class="text-muted small">Offline</div>
                    </div>
                    <div class="text-muted small ml-3">
                      <div>{{ $t('component.post.registerDate') }} <strong>01/1/2019</strong></div>
                      <div><strong>134</strong> {{ $t('component.post.messages') }}</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-9">
                <div class="card-body">
                  <p class="card-text text-muted"><small class="text-muted">Last updated 3 mins ago</small></p>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                  </p>

                  <div class="d-flex justify-content-start mt-1 mx-2 mb-1">
                    <div class="text-sm op-5">
                      <span class="text-black px-1 mr-2">#JS</span> <span class="text-black px-1 mr-2">#PHP</span> <span class="text-black px-1 mr-2">#C++</span>
                    </div>
                  </div>

                  <div class="mt-2 d-block d-md-flex d-lg-flex d-xl-flex justify-content-between">
                    <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                      <button class="btn btn-xs text-muted has-icon"><i class="far fa-heart"></i> 1</button>
                      <span class="text-muted d-inline-flex align-items-center align-middle ml-4">
                        <i class="fa fa-eye text-muted fsize-3"></i>&nbsp; <span class="align-middle"> 112</span>
                      </span>
                    </div>
                    <div class="flex-sm-row d-md-flex d-lg-flex d-xl-flex text-center">
                      <button class="btn btn-sm btn-outline-danger mx-1" data-bs-toggle="modal" data-bs-target="#report-form">{{ $t('component.post.report') }}</button>
                      <button class="btn btn-sm btn-outline-primary mx-1">{{ $t('component.post.reply') }}</button>
<!--                      <button class="btn btn-sm btn-outline-secondary mx-1">{{ $t('component.post.edit') }}</button>-->
                      <span class="mx-1 p-2"> <i class="far fa-bookmark" style="cursor: pointer"></i></span>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>    
    </div>
</template>

<script>
import TopicMainPostHeader from './TopicMainPostHeader.vue';

export default{
    name: "TopicMainPost",
    components: { TopicMainPostHeader }
}
</script>