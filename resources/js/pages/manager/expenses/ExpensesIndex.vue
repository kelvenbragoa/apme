<script setup>
import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent, watch } from "vue";
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



const expenses = ref({'data': []})

let userIdBeingDeleted = ref(null);

const form = reactive({
  name: '',
  user_id:1,
})


 const getExpenseList = async (page=1) => {
  axios.get(`/manager-expenses?page=${page}`,
      {
        params:  {
          query: searchQuery.value
        }
      }
      )
       .then((response)=>{
        expenses.value = response.data;
        loadingDiv.value=false;
       })
}

const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});

const createCategoryFunction = (values, {resetForm}) => {
  axios.post('/manager-expenses',values).then((response)=>{

    categories.value.unshift(response.data);
    $('#createCategory').modal('hide');
    resetForm();
  })
};

const confirmExpenseDeletion = (expense) => {

  userIdBeingDeleted = expense.id;
  console.log(expenses.value.data);
  $('#deleteExpenseModal').modal('show');
  // axios.post('/categories',values).then((response)=>{

  //   categories.value.unshift(response.data);
  //   $('#createCategory').modal('hide');
  //   resetForm();
  // })
};

const deleteExpense = () =>{

  loadingButtonDelete.value= true;
  axios.delete(`/manager-expenses/${userIdBeingDeleted}`)
  .then(()=>{
    expenses.value.data = expenses.value.data.filter(expense=>expense.id !== userIdBeingDeleted); 
    $('#deleteExpenseModal').modal('hide');

    toastr.success('Despesa apagada com sucesso');

  }).catch(()=>{
    toastr.error('Erro ao apagar');
    loadingButtonDelete.value= false;
    $('#deleteExpenseModal').modal('hide');
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
  getExpenseList();
},300));

onMounted(()=>{
     getExpenseList();
})

</script>


<template>
<div v-if="!loadingDiv">
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Despesas</h5>
            <p class="mb-0">Despesas : {{ expenses.data.length }}</p>
            <!-- <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createCategory">
              Criar Despesa 1
            </button> -->
            <div class="d-flex justify-content-between">
              <router-link to="/manager/expenses/create"  class="btn btn-primary m-2">
              <i class="ti ti-plus"></i> Criar Despesa
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
      <th scope="col">Despesa</th>
      <th scope="col">Valor</th>
      <th scope="col">Criado por</th>
      <th scope="col">Data</th>
      
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody v-if="expenses.data.length > 0">
    <tr v-for="(expense,index) in expenses.data" :key="expense.id">
      <th scope="row">{{ index+1 }}</th>
      <td>{{ expense.name }}</td>
      <td>{{ expense.amount }} MT</td>
      <td>{{ expense.user.name }}</td>
      <td>{{ moment(expense.date).format('DD-MM-YYYY') }}</td>
      <td>
        <router-link :to="'/manager/expenses/'+expense.id+'/edit'"><i class="ti ti-edit"></i></router-link>
        <router-link :to="'/manager/expenses/'+expense.id"><i class="ti ti-eye"></i></router-link>
        <a href="#" @click.prevent="confirmExpenseDeletion(expense)"><i class="ti ti-trash"></i></a>
      </td>


   
    </tr>
   
   
  </tbody>
  <tbody v-else>
    <tr>
      <td colspan="6" align="center">Nenhum resultado encontrado</td>
    </tr>
  </tbody>
</table>


          </div>
</div>






<!-- Modal -->
<div class="modal fade" id="deleteExpenseModal" tabindex="-1" role="dialog" aria-labelledby="deleteExpenseLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteExpenseLabel">Confirmar a exclusão da Despesa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja realmente apagar esta Despesa?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
        <button @click.prevent="deleteExpense" type="button" class="btn btn-danger" :disabled="loadingButtonDelete">
          <div v-if="loadingButtonDelete" class="spinner-border spinner-border-sm" role="status"></div>
          <span v-else>Apagar Despesa</span>
          
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