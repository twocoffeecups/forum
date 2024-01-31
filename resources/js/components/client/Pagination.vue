<template>
    <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-4">
        <ul class="pagination">
            <li v-if="currentPage !== 1" class="page-item">
                <a @click.prevent="selectPage(currentPage - 1)" class="page-link" href="#">{{ $t('component.pagination.previous') }}</a>
            </li>
            <li v-if="links" v-for="link in links" class="page-item">
                <template v-if="Number(link.label)">
                    <a @click.prevent="selectPage(link.label)" class="page-link" href="#">{{ link.label }}</a>
                </template>
            </li>
            <li v-if="currentPage !== lastPage" class="page-item">
                <a @click.prevent="selectPage(currentPage + 1)" class="page-link" href="#">{{ $t('component.pagination.next') }}</a>
            </li>
        </ul>
    </nav>
</template>

<script>
export default{
    name:'Pagination',
    props: ['totalPages', 'links', 'id', 'currentPage', 'lastPage'],
    emits: ['selectPageEmit'],

    methods: {
        selectPage(page){
            this.$emit('selectPageEmit', page);
        }
    }
}
</script>

<style scoped>

</style>
