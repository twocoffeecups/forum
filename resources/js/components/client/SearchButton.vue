<template>

    <div class="d-flex justify-content-center align-items-center my-2 mx-0 mx-sm-0 mx-md-0 mx-lg-2">

    <span class=" d-flex align-items-center" @click="toggleSearchForm">
      <i class="fas fa-search mx-2" role="button" title="Search"></i>
      <span v-if="!showForm" class="d-sm-block d-md-block d-lg-none">Search</span>
    </span>

        <input v-if="showForm" class="form-control-sm mx-auto search-form" type="search" placeholder="Search"
               aria-label="Search">
    </div>

</template>

<script>
export default {
    name: "SearchButton",

    created() {
        const onResize = () => this.width = window.innerWidth;
        onResize();
        window.addEventListener('resize', onResize);
    },

    updated() {
        const onResize = () => this.width = window.innerWidth;
        onResize();
        window.addEventListener('resize', onResize);
    },


    data() {
        return {
            width: 0,
            showForm: false
        }
    },

    methods: {
        toggleSearchForm() {
            this.showForm = !this.showForm;
        }
    },


}
</script>

<style scoped>
.search-form {

}
</style>
