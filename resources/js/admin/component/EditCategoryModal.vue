<template>
    <span role="button" class="text-primary" data-bs-toggle="modal" :data-bs-target="`#edit-category-${id}-modal`" title="Edit">
        <i class="fas fa-edit"></i>
    </span>

    <div class="modal fade" :id="`edit-category-${id}-modal`" tabindex="-1" :aria-labelledby="`edit-category-${id}-modal`" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit category</h1>
                </div>
                <div class="modal-body">

                    <div class="mb-3 form-group">
                        <div :class="{ error: v$.name.$errors.length }">
                            <label for="name" class="col-form-label">Name:</label>
                            <input @blur="v$.name.$touch" type="text" v-model="name" class="form-control" id="name">
                            <div class="input-errors" v-for="error of v$.name.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input v-model="isChild" type="checkbox" class="form-check-input" id="is-child">
                        <label class="form-check-label" for="is-child">Child category</label>
                    </div>

                    <div v-if="isChild" class="mb-3 form-group">
                        <select @change="changeCategory($event)" class="form-control">
                            <CategoryOptionTree v-for="category in categories" :is-selected="parentId" :name="category.name" :id="category.id" :children="category.children" :indent="0" />
                        </select>
                    </div>

                    <div class="mb-3 form-group">
                        <div :class="{ error: v$.description.$errors.length }">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea @blur="v$.description.$touch" class="form-control" v-model="description" id="description"></textarea>
                            <div class="input-errors" v-for="error of v$.description.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click="updateCategory" data-bs-dismiss="modal" type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core';
import { required, minLength, maxLength, } from '@vuelidate/validators';
import CategoryOptionTree from "./CategoryOptionTree.vue";
export default {
    name: "EditCategoryModal",
    components: {CategoryOptionTree},
    props:['id','name', 'parentId', 'description'],

    setup(){
        return{
            v$: useVuelidate()
        }
    },

    data(){
        return{
            isChild: !!this.parentId,
            selectedCategory: this.parentId,
            categories:[
                {
                    id: 1,
                    name: 'Root category 1',
                    children:[
                        {
                            id: 2,
                            name: 'Parent category 1',
                            children:[
                                {
                                    id: 3,
                                    name: 'Child category 1.1',
                                },
                                {
                                    id: 4,
                                    name: 'Child category 1.2',
                                },
                            ],
                        },
                        {
                            id: 5,
                            name: 'Parent category 2',
                            children:[
                                {
                                    id: 6,
                                    name: 'Child category 2.1',
                                    children:[
                                        {
                                            id: 7,
                                            name: 'Child category 2.1.1',
                                        },
                                    ],
                                },
                                {
                                    id: 8,
                                    name: 'Child category 2.2',
                                },
                                {
                                    id: 9,
                                    name: 'Child category 2.3',
                                },
                            ],
                        },
                    ],
                },
                {
                    id: 10,
                    name: 'Root category 2',
                    children:[
                        {
                            id: 11,
                            name: 'Parent category 3',
                            children:[
                                {
                                    id: 12,
                                    name: 'Child category 3.1',
                                },
                                {
                                    id: 13,
                                    name: 'Child category 3.2',
                                },
                            ],
                        },
                    ],
                }
            ],
        }
    },

    validations(){
        return{
            name:{required, minLength:minLength(3), maxLength:maxLength(64),},
            description:{required, minLength:minLength(32), maxLength:maxLength(255),},
        }
    },


    methods:{
        updateCategory(){
            this.v$.$validate();
            if(!this.v$.$error){
                axios.patch(`/api/admin/forum/category/${this.id}`, {
                    name: this.name,
                    description: this.description,
                    parentId: this.selectedCategory ?? this.parentId,
                })
                .then(res =>{
                    console.log(res.data)
                })
                .catch(error => {
                    console.log(error)
                })
            }else{
                console.log('errors')
            }

        },

        changeCategory(e){
            console.log('change category', e.target.value)
            this.selectedCategory = e.target.value
        },
    },
}
</script>

<style scoped>

</style>
