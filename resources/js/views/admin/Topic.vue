<template>
  <div class="row mb-3">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
      <div class="card text-bg-primary bg-gradient mb-3 col" style="max-width: 360px; max-height: 145px;">
        <div class="card-body">
          <div class="d-flex">
            <div class="col">
              <h2>123</h2>
              <span class="fst-italic">All topics</span>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
              <i class="fas fa-comments" style="font-size: 2.3em"></i>
            </div>
          </div>
        </div>
<!--        <div class="card-footer">-->
<!--          <p class="card-text text-center" role="button">More info <i class="fas fa-arrow-circle-right"></i></p>-->
<!--        </div>-->
      </div>
    </div>


    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
      <div class="card text-bg-danger bg-gradient mb-3 col" style="max-width: 360px; max-height: 145px;">
        <div class="card-body">
          <div class="d-flex">
            <div class="col">
              <h2>21</h2>
              <span class="fst-italic">NEW</span>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
              <i class="far fa-flag" style="font-size: 2.3em"></i>
            </div>
          </div>
        </div>
<!--        <div class="card-footer">-->
<!--          <p class="card-text text-center" role="button">More info <i class="fas fa-arrow-circle-right"></i></p>-->
<!--        </div>-->
      </div>
    </div>

<!--    <div class="col-12 col-sm-12 col-md-6 col-lg-3">-->
<!--      <div class="card text-bg-success bg-gradient mb-3 col" style="max-width: 360px; max-height: 145px;">-->
<!--        <div class="card-body">-->
<!--          <div class="d-flex">-->
<!--            <div class="col">-->
<!--              <h2>14</h2>-->
<!--              <span class="fst-italic">Categories</span>-->
<!--            </div>-->
<!--            <div class="col d-flex justify-content-center align-items-center">-->
<!--              <i class="fas fa-tags" style="font-size: 2.3em"></i>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="card-footer">-->
<!--          <p class="card-text text-center" role="button">More info <i class="fas fa-arrow-circle-right"></i></p>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
  </div>


  <div class="row mb-3">
    <div class="container-fluid">

      <!-- Table card -->
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between my-2">
            <h4>All Forums</h4>
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
                <th scope="col">Forum</th>
                <th scope="col">Title</th>
                <th scope="col">User</th>
                <th scope="col">Posts</th>
                <th scope="col">Status</th>
                <th scope="col">Created AT</th>
                <th scope="col">Allow | Disallow Publication</th>
                <th scope="col">Actions</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="topic in topics">
                <th scope="row">{{ topic.id }}</th>
                <td>{{ topic.forum }}</td>
                <td>{{ topic.title }}</td>
                <td>{{ topic.user }}</td>
                <td>{{ topic.posts }}</td>
                <td>{{ topic.status }}</td>
                <td>{{ topic.created_at }}</td>
                <th>
                  <div v-if="!topic.status" class="btn-group  btn-group-sm" role="group" aria-label="Basic radio toggle button group" @change.prevent="changePublished($event, topic.id)">
                    <input type="radio" class="btn-check" :name="topic.id+'isPublished'" :id="topic.id+'hide'" value="false" autocomplete="off" :checked="topic.status !== true">
                    <label class="btn btn-outline-danger" :for="topic.id+'hide'">Reject Publication</label>

                    <input type="radio" class="btn-check" :name="topic.id+'isPublished'" :id="topic.id+'published'" value="true" autocomplete="off" :checked="topic.status === true">
                    <label class="btn btn-outline-success" :for="topic.id+'published'">Allow Publication</label>
                  </div>
                 <span v-if="topic.status">Published</span>

                </th>
                <td>

                  <span role="button" class="text-primary mx-2" title="Show">
                    <i class="far fa-eye"></i>
                  </span>

                  <span role="button" class="text-danger mx-2" title="Delete">
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
export default {
  name: "Topic",

  data(){
    return{
      topics:[
        {
          id: 1,
          forum: 'Forum 1',
          title: 'First topic',
          user: 'User Userovich',
          posts: 2,
          status: false,
          created_at: '2023-11-01',
        }
      ],
    }
  },

  methods:{
    changePublished(e, id){
      console.log('id: ', id, e);
    }
  },


}
</script>

<style scoped>

</style>