<template>
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#create-category-modal">+ CRETE CATEGORY</button>
    </div>

    <div class="modal fade" id="create-category-modal" tabindex="-1" aria-labelledby="create-category-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Create category</h1>
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
                        <select @change="changeCategory($event)" class="form-control" aria-label="Default select example">
                            <CategoryTree2 v-for="category in categories" :is-selected="selectedCategory" :name="category.name" :id="category.id" :children="category.children" :indent="0" />
                        </select>
                    </div>

<!--                    <div v-if="isChild" class="mb-3 form-group">-->
<!--                        <CategoryTree @selectCategoryEmit="selectCategoryEmit" v-for="category in categories" :is-selected="selectedCategory.id" :name="category.name" :id="category.id" :children="category.children" :indent="0" />-->
<!--                    </div>-->

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
                    <button @click="createCategory" type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core';
import { required, minLength, maxLength, } from '@vuelidate/validators';
import CategoryTree2 from "./CategoryTree2.vue";
export default {
    name: "CreateCategoryModal",
    components: {CategoryTree2, CategoryTree},
    setup(){
        return{
            v$: useVuelidate()
        }
    },

    data(){
        return{
            name:null,
            isChild: false,
            description: null,

            isSelected: null,
            showCategory: null,
            selectedCategory: null,
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
            name:{required, minLength:minLength(2), maxLength:maxLength(12),},
            description:{required, minLength:minLength(32), maxLength:maxLength(120),},
        }
    },

    methods:{
        createCategory(){
            this.v$.$validate();
            let parentCategory = this.isChild ? this.selectedCategory : 0
            if(!this.v$.$error){
                console.log('Category name: ', this.name)
                console.log('Category description: ', this.description)
                console.log('Parent category: ', parentCategory)
                console.log('Created category');
            }else{
                console.log('Error!');
            }
        },

        changeCategory(e){
            console.log('change category', e.target.value)
            this.selectedCategory = e.target.value
        },

        selectCategoryEmit(data){
            this.selectedCategory = data
            console.log('Parent category', this.selectedCategory)
        },
    }
}
</script>

<style scoped>

</style>
