<template>
    <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-4">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">{{ $t('component.pagination.previous') }}</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">{{ $t('component.pagination.next') }}</a></li>
        </ul>
    </nav>
</template>

<script>
export default{
    name:'Pagination',
}
</script>

<style scoped>

</style>