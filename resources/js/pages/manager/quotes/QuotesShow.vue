<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';
import moment from 'moment';
import formatDate from './../../../helper';

let quote =ref([]);
let loading =ref([true]);
const router = useRouter();
let self = this;

const getQuote = () => {
  axios.get(`/manager-quotes/+${router.currentRoute.value.params.id}`)
       .then((response)=>{
        loading.value=false;
        quote.value = response.data;
       }).catch(()=>{
        loading.value=false;
       })
}


const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});


const createCategoryFunction = (values, {resetForm}) => {
  axios.post('/categories',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    resetForm();
    router.push({ path: '/manager/categories' })
  })
};

onMounted(()=>{
  
  getQuote();
})
</script>

<template>
    <div v-if="!loading">
        <router-link to="/manager/quotes" >
            <i class="ti ti-arrow-left"></i>Voltar
        </router-link>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Visualizar Detalhes da Fatura da Quota</h5>

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