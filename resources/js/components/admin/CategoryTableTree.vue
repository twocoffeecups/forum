<template>
  <tr>
    <td colspan="9">
      <table class="table mb-0">
        <tbody>
          <template  v-for="category in categories">
            <tr class="hover-tr">
              <th colspan="row" class="border-0">
                <span class="d-flex flex-row  justify-content-end align-items-center"><i v-if="category.children" class="fas fa-caret-right fa-fw"></i> {{ category.id }}</span>
              </th>
              <td class="border-0">{{ category.name }}</td>
              <td class="ищквук-0">
                {{ category.description }}
              </td>
              <td class="border-0">
                <a v-if="category.children" data-bs-toggle="collapse" :href="`#child-table-${category.id}`" role="button" aria-expanded="false" :aria-controls="`child-table-${category.id}`">Show</a>
                <span v-if="!category.children">No</span>
              </td>
              <td class="border-0">{{ category.topics }}</td>
              <td class="border-0">{{ category.posts }}</td>
              <td class="border-0">{{ category.createdAt }}</td>
              <td class="border-0">
                <div class="btn-group  btn-group-sm" role="group" aria-label="Basic radio toggle button group" @change.prevent="changeVisibility($event, category.id)">
                  <input type="radio" class="btn-check" :name="category.id+'isPublished'" :id="category.id+'hide'" value="false" autocomplete="off" :checked="category.visibility !== true">
                  <label class="btn btn-outline-secondary" :for="category.id+'hide'">Hide</label>

                  <input type="radio" class="btn-check" :name="category.id+'isPublished'" :id="category.id+'published'" value="true" autocomplete="off" :checked="category.visibility === true">
                  <label class="btn btn-outline-success" :for="category.id+'published'">Publish</label>
                </div>
              </td>
              <td class="border-0">
                <EditCategoryModal :id="category.id" :category-name="category.name" :category-description="category.description" />
                 <span @click="deleteCategory(category.id)" role="button" class="text-danger mx-2" title="Delete">
                    <i class="fas fa-trash"></i>
                 </span>
              </td>
            </tr>
            <CategoryTableTree v-if="category.children" :id="`child-table-${category.id}`" class="collapse" :parent-id="category.id" :categories="category.children" />
          </template>
        </tbody>
      </table>
    </td>
  </tr>

</template>

<script>
import EditCategoryModal from "./EditCategoryModal.vue";
import axios from "axios";
export default {
  name: "CategoryTableTree",
  components:{EditCategoryModal},
  props: ['parentId', 'categories'],

  methods:{

    async changeVisibility(event, id){
      let value = event.target.value;
      console.log('Visibility: ', value, ' ID: ', id)
      // await axios.post(`/api/admin/category/${id}/visibility`,{
      //   visibility: value,
      // })
      //     .then(res => {
      //       console.log(res);
      //     })
      //     .catch(error => {
      //       console.log(error);
      //     })

    },

    deleteCategory(id){
      console.log('delete')
    }
  },
}
</script>

<style scoped>
.hover-tr:hover{
  background-color: #0dcaf0;
}
</style>