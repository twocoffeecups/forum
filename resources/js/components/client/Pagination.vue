<template>
    <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-4">
        <ul class="pagination">
            <li v-if="currentPage !== 1" class="page-item">
                <a @click.prevent="getTopics(currentPage - 1)" class="page-link" href="#">{{ $t('component.pagination.previous') }}</a>
            </li>
            <li v-for="link in links" class="page-item">
                <template v-if="Number(link.label)">
                    <a @click.prevent="getTopics(link.label)" class="page-link" href="#">{{ link.label }}</a>
                </template>
            </li>
            <li v-if="currentPage !== lastPage" class="page-item">
                <a @click.prevent="getTopics(currentPage + 1)" class="page-link" href="#">{{ $t('component.pagination.next') }}</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default{
    name:'Pagination',
    props: ['totalPages', 'links', 'forumId', 'currentPage', 'lastPage'],

    methods: {
        getTopics(page){
            this.$store.dispatch('forumTopics/getTopics', [this.forumId, page]);
        }
    }
}
</script>

<style scoped>

</style>
