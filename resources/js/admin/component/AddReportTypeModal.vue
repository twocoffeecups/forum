<template>
    <div class="d-flex justify-content-start mb-3">
        <button class="btn btn-primary mx-1" data-bs-toggle="modal" data-bs-target="#create-report-type-modal">+ CRETE REPORT TYPE</button>
    </div>

    <div class="modal fade" id="create-report-type-modal" tabindex="-1" aria-labelledby="create-report-type-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Create user</h1>
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
                    <button @click="createReportType" type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useVuelidate } from '@vuelidate/core';
import { required, minLength, maxLength, } from '@vuelidate/validators';
export default{
    name: "AddReportTypeModal",

    setup(){
        return{
            v$: useVuelidate()
        }
    },

    data(){
        return{
            name:null,
            description:null,
        }
    },

    validations(){
        return{
            name: {required, minLength:minLength(3), maxLength:maxLength(32)},
            description: {required, minLength:minLength(50), maxLength:maxLength(255)},
        }
    },

    methods:{
        createReportType(){
            this.v$.$validate();
            if(!this.v$.$error){
                console.log('Add!');
            }else{
                console.log('error');
            }
        }
    },

}
</script>

<style scoped>

</style>