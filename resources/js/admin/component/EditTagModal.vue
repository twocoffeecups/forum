<template>

    <span role="button" class="text-primary" data-bs-toggle="modal" :data-bs-target="`#edit-tag-${id}-modal`" title="Edit">
        <i class="fas fa-edit"></i>
    </span>

    <div class="modal fade" :id="`edit-tag-${id}-modal`" tabindex="-1" :aria-labelledby="`edit-tag-${id}-modal`" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Edit tag</h1>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <div :class="{ error: v$.name.$errors.length }">
                            <label for="name" class="col-form-label">Name:</label>
                            <input @blur="v$.name.$touch" type="text" v-model="name" class="form-control" id="name">
                            <div class="input-errors" v-for="error of v$.name.$errors" :key="error.$uid">
                                <div class="error-msg text-danger">{{ error.$message }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
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
                    <button @click="updateTag" data-bs-dismiss="modal" type="button" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core';
import {maxLength, minLength, required} from "@vuelidate/validators";
export default {
    name: "EditTagModal",
    props:['id','name','description'],

    setup(){
        return{
            v$: useVuelidate()
        }
    },

    data(){
        return{

        }
    },

    validations(){
        return{
            name:{required, minLength:minLength(2), maxLength:maxLength(24),},
            description:{required, minLength:minLength(32), maxLength:maxLength(255),},
        }
    },

    methods:{
        updateTag(){
            this.v$.$validate();
            if(!this.v$.$error){
                // console.log('name', this.name)
                // console.log('description', this.description)
                // console.log('tage created')

                axios.patch(`/api/admin/forum/tag/${this.id}`, {
                    name: this.name,
                    description: this.description
                })
            }else{
                console.log('error');
            }
        }
    }
}
</script>

<style scoped>

</style>
