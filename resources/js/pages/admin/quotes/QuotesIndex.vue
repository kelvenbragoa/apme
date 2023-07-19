<script setup>
import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent,watch } from "vue";
import {Form, Field} from 'vee-validate';
import * as yup from 'yup';
import {useToastr} from '../../../toastr';
import moment from 'moment'
import {debounce} from 'lodash';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';


const toastr = useToastr();
const searchQuery = ref(null);
const loadingDiv = ref(true);
const loadingButtonDelete = ref(false);



const quotes = ref({'data': []})

let userIdBeingDeleted = ref(null);

const form = reactive({
  name: '',
  user_id:1,
})


 const getQuoteList = async (page = 1) => {
  axios.get(`/quotes?page=${page}`,
  {
        params:{
          query: searchQuery.value
        }
      }
  )
       .then((response)=>{
        quotes.value = response.data;
        loadingDiv.value=false;
       })
}

const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});

const createCategoryFunction = (values, {resetForm}) => {
  axios.post('/quotes',values).then((response)=>{

    categories.value.unshift(response.data);
    $('#createCategory').modal('hide');
    resetForm();
  })
};

const confirmQuoteDeletion = (quote) => {

   userIdBeingDeleted = quote.id;
  console.log(userIdBeingDeleted);
  $('#deleteQuoteModal').modal('show');
  // axios.post('/categories',values).then((response)=>{

  //   categories.value.unshift(response.data);
  //   $('#createCategory').modal('hide');
  //   resetForm();
  // })
};

const deleteQuote = () =>{

  loadingButtonDelete.value= true;
  axios.delete(`/quotes/${userIdBeingDeleted}`)
  .then(()=>{
    quotes.value = quotes.value.filter(quote=>quote.id !== userIdBeingDeleted); 
    $('#deleteQuoteModal').modal('hide');

    toastr.success('Quota apagada com sucesso');

  }).catch(()=>{
    toastr.error('Erro ao apagar');
    loadingButtonDelete.value= false;
    $('#deleteQuoteModal').modal('hide');
  }).finally(()=>{
    loadingButtonDelete.value= false;
  });
}
// const createCategory = () => {
//   axios.post('/categories',form)
//   .then((response)=>{
//     categories.value.unshift(response.data);
//     form.name ='';
    
    
//     $('#createCategory').modal('hide');
//   });
// }

watch(searchQuery,debounce(()=>{
  getQuoteList();
},300));

onMounted(()=>{
     getQuoteList();
})

</script>


<template>
<div v-if="!loadingDiv">
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Quotas dos Associados</h5>
            <p class="mb-0">Quotas: {{ quotes.data.length }}</p>
            <!-- <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createCategory">
              Criar Quota 1
            </button> -->
            <div class="d-flex justify-content-between">
              <router-link to="/admin/quotes/create"  class="btn btn-primary m-2">
                <i class="ti ti-plus"></i> Criar Fatura
              </router-link>
              <div>
                <input class="form-control" v-model="searchQuery" placeholder="Procurar..." type="text">
                <!-- <button @click.prevent="search" >Submit</button> -->
              </div>
            </div>
            <table class="table">
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
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody v-if="quotes.data.length > 0">
    <tr v-for="(quote,index) in quotes.data" :key="quote.id">
      <th scope="row">{{ index+1 }}</th>
      <td>{{ quote.ref }}</td>
      <td>{{ quote.company.company_name }}</td>
      <td>{{ quote.company.invoice_email }}</td>
      <td>{{ quote.frequency.name }}</td>
      <td>{{ quote.amount }} MT</td>
      <td>{{ moment(quote.start_date).format('DD-MM-YYYY') }}</td>
      <td>{{ moment(quote.end_date).format('DD-MM-YYYY') }}</td>
      <td>
        <span class="badge bg-danger rounded-3 fw-semibold" v-if="quote.status==0">Não Pago</span> <span class="badge bg-success rounded-3 fw-semibold" v-else>Pago</span>  
      </td>
      <td>
        <router-link :to="'/admin/quotes/'+quote.id+'/edit'"><i class="ti ti-edit"></i></router-link>
        <router-link :to="'/admin/quotes/'+quote.id"><i class="ti ti-eye"></i></router-link>
        <a href="#" @click.prevent="confirmQuoteDeletion(quote)"><i class="ti ti-trash"></i></a>
      </td>


   
    </tr>
   
   
  </tbody>
  <tbody v-else>
    <tr>
      <td colspan="10" align="center">Nenhum resultado encontrado</td>
    </tr>
  </tbody>
</table>


          </div>
</div>

<Bootstrap4Pagination :data="quotes" @pagination-change-page="getQuoteList"/>






<!-- Modal -->
<div class="modal fade" id="deleteQuoteModal" tabindex="-1" role="dialog" aria-labelledby="deleteQuoteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteQuoteLabel">Confirmar a exclusão da Quota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja realmente apagar esta Quota?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
        <button @click.prevent="deleteQuote" type="button" class="btn btn-danger" :disabled="loadingButtonDelete">
          <div v-if="loadingButtonDelete" class="spinner-border spinner-border-sm" role="status"></div>
          <span v-else>Apagar Quota</span>
          
        </button>
      </div>
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