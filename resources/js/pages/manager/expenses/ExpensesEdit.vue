<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';
import {useToastr} from '../../../toastr';

const toastr = useToastr();
const loadingButtonSubmit = ref(false);
const loadingDiv = ref(true);
let expense =ref([]);
const router = useRouter();
let self = this;

const getExpense = () => {
  axios.get(`/manager-expenses/+${router.currentRoute.value.params.id}/edit`)
       .then((response)=>{
        expense.value = response.data;
        loadingDiv.value=false;


       })
}


const schema = yup.object({
  name: yup.string().required(),
   amount: yup.number().required(),
   date: yup.date().required(),
});


const editExpenseFunction = (values, actions) => {
  loadingButtonSubmit.value = true;
  axios.patch('/manager-expenses',values).then((response)=>{

    // expenses.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    
    actions.resetForm();
    router.push({ path: '/manager/expenses' });
    toastr.success('Despesa editada com sucesso');
    
  })
  .catch((error)=>{
    loadingButtonSubmit.value = false;
    toastr.error('Erro ao editar');
    if(error.response.data.errors){
       
      actions.setErrors(error.response.data.errors);
    }
  }).finally(()=>{
    loadingButtonSubmit.value = false;
  })
};

onMounted(()=>{
  
  getExpense();
})
</script>

<template>
  <div v-if="!loadingDiv">
    <router-link to="/manager/expenses" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Editar Despesa</h5>
            
            <Form @submit="editExpenseFunction" :validation-schema="schema" v-slot="{ errors }">
                    <div class="mb-3">
                        <label for="nameExpense" class="form-label">Nome</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.name}" v-model="expense.name"  name="name" id="nameExpense" aria-describedby="nameExpense"/>
                        <span class="invalid-feedback">{{ errors.name }}</span>
                        <Field type="hidden" class="form-control" :class="{'is-invalid':errors.id}" v-model="expense.id"  name="id" id="idExpense" aria-describedby="idExpense"/>
                        
                      
                    </div>
                    <div class="mb-3">
                        <label for="amountExpense" class="form-label">Valor</label>
                        <Field type="number" class="form-control" :class="{'is-invalid':errors.amount}" v-model="expense.amount"  name="amount" id="amountExpense" aria-describedby="amountExpense"/>
                        <span class="invalid-feedback">{{ errors.mobile }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="dateExpense" class="form-label">Data</label>
                        <Field type="date" class="form-control" :class="{'is-invalid':errors.date}" v-model="expense.date" readonly name="date" id="dateExpense" aria-describedby="dateExpense"/>
                        <span class="invalid-feedback">{{ errors.date }}</span>
                    </div>
                   
                   
                    <button type="submit" class="btn btn-primary" :disabled="loadingButtonSubmit">
                        <div v-if="loadingButtonSubmit" class="spinner-border spinner-border-sm" role="status"></div>
                        <span v-else>Submeter</span>
                        
                    </button>
            </Form>
          </div>
    </div>
  </div>
  <div v-else>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                Carregando Dados...
            </div>

        </div>
        
    </div>

</div>
</template>