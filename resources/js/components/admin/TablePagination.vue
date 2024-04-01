<template>
    <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-between">
        <div class="d-flex mt-1 d-none d-md-block d-lg-block d-xl-block align-items-center">
<!--            <div class="table-info" id="table-info" role="status" aria-live="polite">Showing 4 to 10 of-->
<!--                {{ totalEntries }} entries-->
<!--            </div>-->
        </div>
        <div v-if="totalPages !==1" class="d-flex justify-content-center mt-1">
            <nav>
                <ul class="pagination" style="color: black">
                    <li v-if="currentPage !== 1" class="page-item">
                        <a @click.prevent="selectPage(currentPage-1)" class="page-link" href="#">{{ $t('component.pagination.previous') }}</a>
                    </li>
                    <li v-for="link in links" class="page-item">
                        <template v-if="Number(link.label)">
                            <a @click.prevent="selectPage(link.label)" class="page-link" href="#">{{ link.label }}</a>
                        </template>
                    </li>
                    <li v-if="currentPage !== totalPages" class="page-item">
                        <a @click.prevent="selectPage(currentPage+1)" class="page-link" href="#">{{ $t('component.pagination.next') }}</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
export default{
    name:'TablePagination',
    props: ['totalPages', 'links', 'id', 'currentPage', 'lastPage', 'totalEntries'],
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
