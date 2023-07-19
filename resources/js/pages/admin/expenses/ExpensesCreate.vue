<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter } from "vue-router";
import * as yup from 'yup';
import {useToastr} from '../../../toastr';

const loading = ref(false);
const toastr = useToastr();
const schema = yup.object({
   name: yup.string().required(),
   amount: yup.number().required(),
   date: yup.date().required(),
   
});
let self = this;
const router = useRouter();
const createExpenseFunction = (values, actions) => {

    loading.value = true;
  axios.post('/expenses',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/expenses' });
    toastr.success('Despesa criado com sucesso');
  }).catch((error)=>{
    loading.value = false;
    toastr.error('Erro ao adicionar');
    if(error.response.data.errors){
       
        actions.setErrors(error.response.data.errors);
    }
  }).finally(()=>{
    loading.value = false;
   
    
  })
//   .catch((error)=>{

//     if(error.response.data.errors){
//         actions.setErrors(error.response.data.errors);
//     }
   
   
//   })
};

// onMounted(()=>{
//     toastr.success('success')
// })
</script>

<template>
    <router-link to="/admin/expenses" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Criar Despesa</h5>
            
            <Form @submit="createExpenseFunction" :validation-schema="schema" v-slot="{ errors }">
                    <div class="mb-3">
                        <label for="nameExpense" class="form-label">Despesa</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.name}"  name="name" id="nameExpense" aria-describedby="nameExpense"/>
                        <span class="invalid-feedback">{{ errors.name }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="amountManager" class="form-label">Valor</label>
                        <Field type="number" class="form-control" :class="{'is-invalid':errors.amount}"  name="amount" id="amountManager" aria-describedby="amountManager"/>
                        <span class="invalid-feedback">{{ errors.amount }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="dateManager" class="form-label">Data</label>
                        <Field type="date" class="form-control" :class="{'is-invalid':errors.date}"  name="date" id="dateManager" aria-describedby="dateManager"/>
                        <span class="invalid-feedback">{{ errors.date }}</span>
                    </div>

                 
                   
                    <button type="submit" class="btn btn-primary" :disabled="loading">
                        <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
                        <span v-else>Submeter</span>
                        
                    </button>
            </Form>
          </div>
    </div>
</template>