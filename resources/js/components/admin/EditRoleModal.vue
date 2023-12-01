<template>
    <span role="button" class="text-primary" data-bs-toggle="modal" :data-bs-target="`#edit-role-${id}-modal`" title="Edit">
        <i class="fas fa-edit"></i>
    </span>

    <div class="modal fade" :id="`edit-role-${id}-modal`" tabindex="-1" :aria-labelledby="`edit-role-${id}-modal`" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="add-role-label">Edit role</h1>
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
                        <input @blur="v$.description.$touch" type="text" v-model="description" class="form-control" id="description">
                        <div class="input-errors" v-for="error of v$.description.$errors" :key="error.$uid">
                          <div class="error-msg text-danger">{{ error.$message }}</div>
                        </div>
                      </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button @click="updateRole" type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core'
import { required, minLength, maxLength, } from '@vuelidate/validators'
import axios from "axios";
export default {
    name: "EditRoleModal",
    props:['id', 'name', 'description',],

    setup () {
        return {
          v$: useVuelidate()
        }
    },

    data(){
        return{
          //id: this.id,
          name: this.name,
          description: this.description,
        }
    },

    validations(){
        return{
            name: {required, minLength:minLength(3), maxLength:maxLength(12), $lazy: true},
            description: {required, minLength:minLength(5), maxLength:maxLength(255), $lazy: true}
        }
    },

    methods:{
        updateRole(){
            this.v$.$validate();
            if(!this.v$.$error){
                axios.patch(`/api/admin/role/${this.id}`, {
                    name: this.name,
                    description: this.description,
                })
                .then(res => {
                    console.log(res);
                })
                .catch(error => {
                    console.log(error);
                })
            }else{
                console.log('errors')
            }
        }
    }
}
</script>

<style scoped>

</style>
