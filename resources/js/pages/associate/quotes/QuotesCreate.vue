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
const refquote = ref('');
const quote = ref([]);
const associates = ref([]);

var date = moment().format('DD/MM/YYYY');
const toastr = useToastr();
const schema = yup.object({
   ref: yup.string().required(),
   company_id: yup.string().required(),
   amount: yup.number().required(),
   start_date: yup.date().required(),
   end_date: yup.date().required(),
   
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
  axios.post('/quotes',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/quotes' });
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

onMounted(()=>{
    getData();
})
</script>

<template>
  <div v-if="!loadingDiv">

  
    <router-link to="/admin/quotes" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Criar Fatura da Quota do Membro {{ quote }}</h5>
            
            <Form @submit="createQuoteFunction" :validation-schema="schema" v-slot="{ errors }">
                    <div class="mb-3">
                        <label for="ref" class="form-label">Referência</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.ref}" v-model="refquote" readonly  name="ref" id="ref" aria-describedby="ref"/>
                        <span class="invalid-feedback">{{ errors.ref }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="company_id" class="form-label">Empresa</label>
                        <Field as="select" class="form-control" :class="{'is-invalid':errors.company_id}"  name="company_id" id="company_id" aria-describedby="company_id">
                          <option value="" disabled>Selecionar</option>
                          <option v-for="associate in associates" :key="associate" :value="associate.id">{{ associate.company_name }} | Ciclo Pagamento: {{ associate.frequency.name }}</option>
                        </Field>
                          <span class="invalid-feedback">{{ errors.company_id }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="amount" class="form-label">Valor</label>
                        <Field type="number" class="form-control" :class="{'is-invalid':errors.amount}"  name="amount" id="amount" aria-describedby="amount"/>
                        <span class="invalid-feedback">{{ errors.amount }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Data Criação</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.start_date}" v-model="date"   name="start_date" id="start_date" readonly aria-describedby="start_date"/>
                        <span class="invalid-feedback">{{ errors.start_date }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Até</label>
                        <Field type="date" class="form-control" :class="{'is-invalid':errors.end_date}"  name="end_date" id="end_date" aria-describedby="end_date"/>
                        <span class="invalid-feedback">{{ errors.end_date }}</span>
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