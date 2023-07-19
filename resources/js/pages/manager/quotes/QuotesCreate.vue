<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter } from "vue-router";
import * as yup from 'yup';
import {useToastr} from '../../../toastr';
import moment from 'moment';

const loading = ref(false);
const loadingDiv = ref(true);
const loadingInfo = ref(false);
const refquote = ref('');
const quote = ref([]);
const associates = ref([]);
const company_id = ref();
const info = ref([])

var date = moment().format('DD/MM/YYYY');
const toastr = useToastr();
const schema = yup.object({
   ref: yup.string().required(),
   company_id: yup.string().required(),
  //  amount: yup.number().required(),
  //  start_date: yup.string().required(),
  //  end_date: yup.date().required(),
   
});
let self = this;
const router = useRouter();
const getData = ()=>{
  axios.get('/global-create-quote')
       .then((response)=>{
        quote.value = response.data.lastquoteid;
        refquote.value = 'APME-QUOTA-'+quote.value;

        associates.value = response.data.associates;
        loadingDiv.value=false;


       })
}
const createQuoteFunction = (values, actions) => {

    loading.value = true;
  axios.post('/manager-quotes',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/manager/quotes' });
    toastr.success('Fatura da Quota do Membro criado com sucesso');
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

const getCompanyInfo = ()=>{

  loadingInfo.value = true;
  
  axios.get(`/manager/company/${company_id.value}/info`)
    .then((response)=>{

      info.value = response.data;
      loadingInfo.value = false;
      
    }).catch(()=>{
      loadingInfo.value = false;
    })
}

onMounted(()=>{
    getData();
})
</script>

<template>
  <div v-if="!loadingDiv">

  
    <router-link to="/manager/quotes" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Criar Fatura da Quota do Membro</h5>
            
            <Form @submit="createQuoteFunction" :validation-schema="schema" v-slot="{ errors }">
                    <div class="mb-3">
                        <label for="ref" class="form-label">Referência</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.ref}" v-model="refquote" readonly  name="ref" id="ref" aria-describedby="ref"/>
                        <span class="invalid-feedback">{{ errors.ref }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="company_id" class="form-label">Empresa</label>
                        <Field as="select" class="form-control" :class="{'is-invalid':errors.company_id}" v-model="company_id" name="company_id" id="company_id" aria-describedby="company_id" @change="getCompanyInfo()">
                          <option value="" disabled>Selecionar</option>
                          <option v-for="associate in associates" :key="associate" :value="associate.id">{{ associate.company_name }} | Ciclo Pagamento: {{ associate.frequency.name }}</option>
                        </Field>
                          <span class="invalid-feedback">{{ errors.company_id }}</span>
                    </div>

            
                    <div class="mb-3">
                        <label for="obs" class="form-label">Informação</label>
                        <div class="text-center" v-if="loadingInfo">
                            <div class="spinner-border" role="status">
                                <span class="sr-only"></span>
                            </div>
                          </div>
                        <div v-if="info.length === 0">
                          
                          <div class="card-body">
                          <div class="text-center">
                            Por favor selecione a empresa para obter informações
                          </div>
                        </div>
                        </div>
                        <div v-else>
                        <div class="card-body">
                          <p>{{ info.msg }}</p>
                          <p>{{ info.lastquote.ref }}</p>
                          <table class="table" v-if="info.table_status == 1">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Ref Quota</th>
                              <th scope="col">Empresa</th>
                              <th scope="col">Email Faturação</th>
                              <th scope="col">Frequência Pagamento</th>
                              <th scope="col">Valor</th>
                              <th scope="col">Criado no dia</th>
                              <th scope="col">Válido até dia</th>
                              <th scope="col">Estado</th>
                             
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td>{{ info.lastquote.ref }}</td>
                              <td>{{ info.lastquote.company.company_name }}</td>
                              <td>{{ info.lastquote.company.invoice_email }}</td>
                              <td>{{ info.lastquote.frequency.name }}</td>
                              <td>{{ info.lastquote.amount }} MT</td>
                              <td>{{ moment(info.lastquote.start_date).format('DD-MM-YYYY') }}</td>
                              <td>{{ moment(info.lastquote.end_date).format('DD-MM-YYYY') }}</td>
                              <td>
                                <span class="badge bg-danger rounded-3 fw-semibold" v-if="info.lastquote.status==0">Não Pago</span> <span class="badge bg-success rounded-3 fw-semibold" v-else>Pago</span>  
                              </td>
                             


                          
                            </tr>
                          
                          
                          </tbody>
                        </table>


                          <p>Nome da Empresa: {{ info.associate.company_name }}</p>
                          <p>Frequencia de pagamento: {{ info.associate.frequency.name }} ({{ info.associate.frequency.months }} meses)</p>
                          <p>Data de inicio da nova fatura da quota: {{ info.start_date }}</p>
                          <p>Data de fim da fatura da quota: {{ moment(info.end_date).format('DD-MM-YYYY') }}</p>
                          <!-- <p>Data Fim da Quota: {{ info.end_date }}</p> -->
                          
                        </div>
                        </div>
                       
                    </div>

                    <div class="mb-3">
                        <label for="obs" class="form-label">Observação</label>
                        <Field type="textarea" class="form-control" :class="{'is-invalid':errors.obs}"  name="obs" id="obs" aria-describedby="obs"/>
                        <span class="invalid-feedback">{{ errors.obs }}</span>
                    </div>

                  

                 
                   
                    <button type="submit" class="btn btn-primary" :disabled="loading">
                        <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
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