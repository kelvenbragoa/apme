<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';
import {useToastr} from '../../../toastr';
import formatDate from './../../../helper';

const toastr = useToastr();
const loadingButtonSubmit = ref(false);
const loadingDiv = ref(true);
let quote =ref([]);
const router = useRouter();
let self = this;

const getQuote = () => {
  axios.get(`/quotes/+${router.currentRoute.value.params.id}/edit`)
       .then((response)=>{
        quote.value = response.data;
        loadingDiv.value=false;


       })
}


const schema = yup.object({
  payment_date: yup.date().required(),
  payment_ref: yup.string().required(),
  
});


const editQuoteFunction = (values, actions) => {
  loadingButtonSubmit.value = true;
  axios.patch('/quotes',values).then((response)=>{

    // quotes.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    
    actions.resetForm();
    router.push({ path: '/admin/quotes' });
    toastr.success('Quota do Membro editada com sucesso');
    
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
  
  getQuote();
})
</script>

<template>
  <div v-if="!loadingDiv">
    <router-link to="/admin/quotes" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Editar Fatura da Quota do Membro</h5>

            <div class="row">
                   
                   <div class="col text-left">
                       <p>APME</p>
                       <P>Maputo</P>
                   </div>
                   <div class="col" style="text-align: right;">
                      <p>Criado no dia: {{ formatDate(quote.start_date) }}</p>
                      <p>Até o dia: {{ formatDate(quote.end_date) }}</p>
                      <p>{{ quote.company.company_name }}</p>
                      <p>{{ quote.company.nuit }}</p>
                      <p>{{ quote.company.address }}</p>
                      <p>{{ quote.company.province.name }}</p>
                       
                   </div>
               </div>

               <div class="row">
                   <p> <strong>Ref:</strong>{{ quote.ref }} </p>
                   <p><strong>Ciclo de pagamento:</strong>{{ quote.frequency.name }}</p>
                   <p><strong>Criada no dia:</strong> {{ formatDate(quote.start_date) }}</p>
                   <p><strong>Até o dia:</strong> {{ formatDate(quote.end_date) }}</p>
                   <p><strong>Estado:</strong> <span v-if="quote.status==1" class="text-success">Pago</span> <span v-else class="text-danger">Não pago</span> </p>
               </div>


               <div class="row">
                   <table class="table">
                       <thead class="thead-dark">
                           <tr>
                               <th>Descrição</th>
                               <th>Ciclo de pagamento</th>
                               <th>Valor</th>
                           </tr>
                       </thead>
                       <tbody>
                           <tr>
                               <td>Quota referente a {{ formatDate(quote.start_date) }} á {{ formatDate(quote.end_date) }}  </td>
                               <td>{{ quote.frequency.name }}</td>
                               <td>{{ quote.amount }} MT</td>
                           </tr>
                           <tr>
                               <td>-</td>
                               <td>-</td>
                               <td>-</td>
                           </tr>
                           <tr>
                               <td>Transação: {{ quote.payment_ref }} | {{ quote.payment_date }}</td>
                              
                           </tr>
                           <tr>
                               <td></td>
                               <td></td>
                               <td>Total: {{ quote.amount }} MT</td>
                           </tr>
                   
                       </tbody>
                   </table>
               </div>
            
            <Form @submit="editQuoteFunction" :validation-schema="schema" v-slot="{ errors }">
                  
                    <div class="mb-3">
                        <label for="payment_ref" class="form-label">Referência do pagamento</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.payment_ref}" v-model="quote.payment_ref"  name="payment_ref" id="payment_ref" aria-describedby="payment_ref"/>
                        <span class="invalid-feedback">{{ errors.payment_ref }}</span>
                        
                        
                      
                    </div>
                    <div class="mb-3">
                        <label for="payment_date" class="form-label">Data do pagamento</label>
                        <Field type="date" class="form-control" :class="{'is-invalid':errors.payment_date}" v-model="quote.payment_date"  name="payment_date" id="payment_date" aria-describedby="payment_date"/>
                        <span class="invalid-feedback">{{ errors.payment_date }}</span>
                        <Field type="hidden" class="form-control" :class="{'is-invalid':errors.id}" v-model="quote.id"  name="id" id="idQuote" aria-describedby="idQuote"/>
                        
                      
                    </div>
                    
                   
                   
                    <button type="submit" class="btn btn-primary" :disabled="loadingButtonSubmit" v-if="quote.status != 1">
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