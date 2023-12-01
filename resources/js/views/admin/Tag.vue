<template>
  <div class="row mb-3">
    <div class="container-fluid">

      <!-- Table card -->
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between my-2">
            <h4>All Tags</h4>
            <div>
<!--              <button class="btn btn-sm btn-success" title="Add new tag">-->
<!--                <i class="fas fa-plus"></i>-->
<!--              </button>-->
              <CreateTagModal />
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
                <th scope="col">Description</th>
                <th scope="col">Topics</th>
                <th scope="col">Created date</th>
                <th scope="col">Visibility</th>
                <th scope="col">Actions</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="tag in tags">
                <th scope="row">{{ tag.id }}</th>
                <td>{{ tag.name }}</td>
                <td>
                  {{ tag.description }}
                </td>
                <td>{{ tag.topics }}</td>
                <td>{{ tag.createdAT }}</td>
                <th>
                  <div class="btn-group  btn-group-sm" role="group" aria-label="Basic radio toggle button group" @change.prevent="changeVisibility($event, tag.id)">
                    <input type="radio" class="btn-check" :name="tag.id+'isPublished'" :id="tag.id+'hide'" value="false" autocomplete="off" :checked="tag.visibility !== true">
                    <label class="btn btn-outline-secondary" :for="tag.id+'hide'">Hide</label>

                    <input type="radio" class="btn-check" :name="tag.id+'isPublished'" :id="tag.id+'published'" value="true" autocomplete="off" :checked="tag.visibility === true">
                    <label class="btn btn-outline-success" :for="tag.id+'published'">Publish</label>
                  </div>

                </th>
                <td>
                  <EditTagModal :id="tag.id" :tag-name="tag.name" :tag-description="tag.description" />

                  <span @click="deleteTag(tag.id)" role="button" class="text-danger mx-2" title="Edit">
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


    </div>
  </div>
</template>

<script>
import axios from "axios";
import CreateTagModal from "../../components/admin/CreateTagModal.vue";
import EditTagModal from "../../components/admin/EditTagModal.vue";
export default {
  name: "Tag",
  components: {EditTagModal, CreateTagModal},

  mounted() {
    //this.getTags();
  },

  data(){
    return{
      tags:[
        {
          id: 1,
          name: 'Tag 1 name',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
          topics: 3,
          visibility: true,
          createdAT: '12.10.2023',
        },
        {
          id: 2,
          name: 'Tag 2 name',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
          topics: 0,
          visibility: true,
          createdAT: '12.10.2023',
        },
        {
          id: 3,
          name: 'Tag 3 name',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
          topics: 2,
          visibility: false,
          createdAT: '12.10.2023',
        },
        {
          id: 4,
          name: 'Tag 4 name',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
          topics: 6,
          visibility: true,
          createdAT: '12.10.2023',
        },
      ],

      visibility: null,

    }
  },

  methods:{

    async getTags(){
      await axios.get('/api/admin/forum/tag/')
          .then(res => {
            this.tags = res.data.tags
            console.log(this.tags);
          })
          .catch(error => {
            console.log(error);
          })
    },

    async deleteTag(id){
      await axios.delete(`/api/admin/forum/tag/${id}`)
          .then(res => {
            console.log(res);
          })
          .catch(error => {
            console.log(error);
          })
    },

    async changeVisibility(event, tagId){
      let value = event.target.value;
      await axios.post(`/api/admin/forum/tag/${tagId}/visibility`,{
        visibility: value,
      })
        .then(res => {
          console.log(res);
        })
        .catch(error => {
          console.log(error);
        })

    },
  }
}
</script>

<style scoped>

</style>