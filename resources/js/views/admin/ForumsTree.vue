<template>
  <div class="row mb-3">
    <div class="container-fluid">

      <!-- Table card -->
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between my-2">
            <h4>All category</h4>
            <div>
              <CreateForumModal />
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
            <table class="table">
              <thead class="table-primary">
                <tr></tr>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Description</th>
                  <th scope="col">Children categories</th>
                  <th scope="col">Topics</th>
                  <th scope="col">Posts</th>
                  <th scope="col">Created date</th>
                  <th scope="col">Visibility</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                <template v-for="forum in forums">
                  <!-- category -->
                  <tr>
                    <th colspan="row">
                      <span class="d-flex flex-row justify-content-end align-items-center"><i v-if="forum.children" class="fas fa-caret-right fa-fw"></i> {{ forum.id }}</span>
                    </th>
                    <td>{{ forum.name }}</td>
                    <td>
                      {{ forum.description }}
                    </td>
                    <td>
                      <a v-if="forum.children" data-bs-toggle="collapse" :href="`#child-table-${forum.id}`" role="button" aria-expanded="false" :aria-controls="`child-table-${forum.id}`">Show</a>
                      <span v-if="!forum.children">No</span>
                    </td>
                    <td>{{ forum.topics }}</td>
                    <td>{{ forum.posts }}</td>
                    <td>{{ forum.createdAt }}</td>
                    <td>
                      <div class="btn-group  btn-group-sm" role="group" aria-label="Basic radio toggle button group" @change.prevent="changeVisibility($event, forum.id)">
                        <input type="radio" class="btn-check" :name="forum.id+'isPublished'" :id="forum.id+'hide'" value="false" autocomplete="off" :checked="forum.visibility !== true">
                        <label class="btn btn-outline-secondary" :for="forum.id+'hide'">Hide</label>

                        <input type="radio" class="btn-check" :name="forum.id+'isPublished'" :id="forum.id+'published'" value="true" autocomplete="off" :checked="forum.visibility === true">
                        <label class="btn btn-outline-success" :for="forum.id+'published'">Publish</label>
                      </div>

                    </td>
                    <td>
                      <EditCategoryModal :id="forum.id" :category-name="forum.name" :category-description="forum.description" />

                      <span class="text-primary mx-2" title="Show">
                        <router-link :to="{ name:'admin.forumDetail', params:{id:1} }" >
                          <i class="fas fa-eye"></i>
                        </router-link>
                      </span>

                      <span @click="deleteForum(forum.id)" role="button" class="text-danger mx-2" title="Edit">
                        <i class="fas fa-trash"></i>
                      </span>

                    </td>
                  </tr>
                  <!-- child table -->
                  <CategoryTableTree v-if="forum.children" :id="`child-table-${forum.id}`" class="collapse" :parent-id="forum.id" :categories="forum.children"/>
<!--                  <tr v-if="category.children" :id="`child-table-${category.id}`" class="collapse">-->
<!--                    <td colspan="9">-->
<!--                      <table class="table mb-0">-->
<!--                        <tbody>-->
<!--                          <tr v-for="child in category.children">-->
<!--                            <th colspan="row">-->
<!--                              <span class="d-flex flex-row align-items-center"><i v-if="child.children" class="fas fa-caret-right fa-fw"></i> {{ child.id }}</span>-->
<!--                            </th>-->
<!--                            <td>{{ child.name }}</td>-->
<!--                            <td>-->
<!--                              {{ child.description }}-->
<!--                            </td>-->
<!--                            <td>-->
<!--                              <a href="#">Yes</a>-->
<!--                            </td>-->
<!--                            <td>{{ child.topics }}</td>-->
<!--                            <td>{{ child.posts }}</td>-->
<!--                            <td>{{ child.createdAt }}</td>-->
<!--                            <td>-->
<!--                              <div class="btn-group  btn-group-sm" role="group" aria-label="Basic radio toggle button group" @change.prevent="changeVisibility($event, child.id)">-->
<!--                                <input type="radio" class="btn-check" :name="child.id+'isPublished'" :id="child.id+'hide'" value="false" autocomplete="off" :checked="child.visibility !== true">-->
<!--                                <label class="btn btn-outline-secondary" :for="child.id+'hide'">Hide</label>-->

<!--                                <input type="radio" class="btn-check" :name="child.id+'isPublished'" :id="child.id+'published'" value="true" autocomplete="off" :checked="child.visibility === true">-->
<!--                                <label class="btn btn-outline-success" :for="child.id+'published'">Publish</label>-->
<!--                              </div>-->
<!--                            </td>-->
<!--                            <td>-->
<!--                              <span @click="deleteCategory(child.id)" role="button" class="text-danger mx-2" title="Edit">-->
<!--                                <i class="fas fa-trash"></i>-->
<!--                              </span>-->
<!--                            </td>-->
<!--                          </tr>-->
<!--                        </tbody>-->
<!--                      </table>-->
<!--                    </td>-->
<!--                  </tr>-->
                </template>
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
import CategoryTableTree from "../../components/admin/CategoryTableTree.vue";
import EditCategoryModal from "../../components/admin/EditCategoryModal.vue";
import CreateForumModal from "../../components/admin/CreateForumModal.vue";
export default {
  name: "ForumsTree",
  components: {CreateForumModal, EditCategoryModal, CategoryTableTree, },

  mounted() {
    //this.getForums();
  },

  data(){
    return{
      forums:[
        {
          id: 1,
          name: 'Category 1',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
          topics: 56,
          posts: 147,
          createdAt: '22.08.2023',
          visibility: true,
          children:[
            {
              id: 2,
              name: 'Category 2',
              description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
              topics: 31,
              posts: 78,
              createdAt: '27.08.2023',
              visibility: true,
              children:[
                {
                  id: 5,
                  name: 'Category 5',
                  description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                  topics: 31,
                  posts: 78,
                  createdAt: '27.08.2023',
                  visibility: true,
                  children:[
                    {
                      id: 6,
                      name: 'Category 6',
                      description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                      topics: 31,
                      posts: 78,
                      createdAt: '27.08.2023',
                      visibility: false,
                    },
                  ]
                },
              ]
            },
            {
              id: 7,
              name: 'Category 7',
              description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
              topics: 31,
              posts: 78,
              createdAt: '27.08.2023',
              visibility: true,
            },
          ]
        },
        {
          id: 3,
          name: 'Category 3',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
          topics: 7,
          posts: 41,
          createdAt: '09.10.2023',
          visibility: false,
        },
        {
          id: 4,
          name: 'Category 4',
          description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
          topics: 0,
          posts: 0,
          createdAt: '13.10.2023',
          visibility: true,
          children: [
            {
              id: 8,
              name: 'Category 8',
              description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
              topics: 31,
              posts: 78,
              createdAt: '27.08.2023',
              visibility: false,
            },
          ]
        },
      ],
    }
  },

  methods:{

    async getForums(){
      await axios.get('/api/admin/category/')
        .then(res => {
          console.log(res)
        })
        .catch(error => {
          console.log(error);
        })
    },

    async changeVisibility(event, id){
      let value = event.target.value;
      await axios.post(`/api/admin/category/${id}/visibility`,{
        visibility: value,
      })
          .then(res => {
            console.log(res);
          })
          .catch(error => {
            console.log(error);
          })

    },

    deleteForum(id){
      console.log('delete')
    }
  }
}
</script>

<style scoped>

</style>