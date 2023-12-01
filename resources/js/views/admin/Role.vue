<template>
  <div class="card">
    <div class="card-header">
      <div class="d-flex justify-content-between my-2">
        <h4>All Roles</h4>
        <div>
          <AddRoleModal />
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive mb-1">
        <div class="d-flex mt-2 flex-column flex-md-row flex-lg-row flex-xl-row justify-content-center justify-content-md-between justify-content-lg-between mb-3">
          <div class="d-none d-md-flex d-lg-flex d-xl-flex my-2">
                <span class="form-text">
                  Show
                </span>
            <select class="form-select form-select-sm mx-2" aria-label="Select entries">
              <option value="10" selected>10</option>
              <option value="30">30</option>
              <option value="50">50</option>
            </select>
            <span class="form-text">entries</span>
          </div>
          <div class="d-flex mx-2 my-2">
            <label class="form-text mx-1">Search: </label>
            <input type="search" class="form-control" id="search" style="max-height: 20px;" />
          </div>
        </div>

        <!-- Table -->
        <table class="table table-striped table-hover table-bordered">
          <thead class="table-primary">
          <tr></tr>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Users</th>
            <th scope="col">Permissions</th>
            <th scope="col">Created AT</th>
            <th scope="col">Actions</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="role in roles">
            <th scope="row">{{ role.id }}</th>
            <td>{{ role.name }}</td>
            <td>{{ role.users }}</td>
            <td>{{ role.permissions }}</td>
            <td>{{ role.created_at }}</td>
            <td>

              <EditRoleModal :id="role.id" :name="role.name" :description="role.description" />

              <span @click="deleteRole(role.id)" role="button" class="text-danger mx-2" title="Edit">
                    <i class="fas fa-trash"></i>
              </span>

            </td>
          </tr>
          </tbody>
        </table>
      </div>

      <div class="d-flex flex-column flex-md-row flex-lg-row justify-content-between">
        <div class="d-flex mt-1 d-none d-md-block d-lg-block d-xl-block align-items-center">
          <div class="table-info" id="table-info" role="status" aria-live="polite">Showing 4 to 10 of 4
            entries
          </div>
        </div>
        <div class="d-flex justify-content-center mt-1">
          <nav>
            <ul class="pagination" style="color: black">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Предыдущая">
                  <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Следующая">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import AddRoleModal from "../../components/admin/AddRoleModal.vue";
import EditRoleModal from "../../components/admin/EditRoleModal.vue";
import axios from "axios";
export default {
  name: "Role",
  components: {EditRoleModal, AddRoleModal},
  data(){
    return{
      'roles': [
        {
          id: 1,
          name: 'Admin',
          description: 'Admin role',
          permissions: '',
          users: 2,
          created_at: '2023-10-06',
        }
      ]
    }
  },


  methods:{
    deleteRole(id){
      console.log('deleted');
      // axios.delete(`/api/admin/role/${this.id}/`)
      //   .then(res => {
      //     console.log(res);
      //   })
      //   .catch(error => {
      //     console.log(error);
      //   })
    }
  }
}
</script>

<style scoped>

</style>