<template>
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-success mx-1" data-bs-toggle="modal" data-bs-target="#add-role-modal">+ ADD ROLE</button>
    </div>

    <div class="modal fade" id="add-role-modal" tabindex="-1" aria-labelledby="add-role-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add-role-label">Add role</h1>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "AddRoleModal",

    data(){
        return{
            isOpen: false,
        }
    }
}
</script>

<style scoped>

</style>
