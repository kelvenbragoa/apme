<script setup>
import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent, watch } from "vue";
import {Form, Field} from 'vee-validate';
import * as yup from 'yup';
import moment from 'moment'
import {debounce} from 'lodash';
import { Bootstrap4Pagination } from 'laravel-vue-pagination';

import {useToastr} from '../../../toastr';


const toastr = useToastr();
const searchQuery = ref(null);
const loadingDiv = ref(true);
const loadingButtonDelete = ref(false);



const associates = ref({'data': []})

let userIdBeingDeleted = ref(null);

const form = reactive({
  name: '',
  user_id:1,
})


 const getAssociateList = async (page=1) => {
  axios.get(`/associates?page=${page}`,{
    params:{
      query: searchQuery.value
    }
  })
       .then((response)=>{
        associates.value = response.data;
        loadingDiv.value=false;
       })
}

const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});

// const createCategoryFunction = (values, {resetForm}) => {
//   axios.post('/associates',values).then((response)=>{

//     categories.value.unshift(response.data);
//     $('#createCategory').modal('hide');
//     resetForm();
//   })
// };

const confirmAssociateDeletion = (admin) => {

   userIdBeingDeleted = admin.id;
  console.log(userIdBeingDeleted);
  $('#deleteAssociateModal').modal('show');
  // axios.post('/categories',values).then((response)=>{

  //   categories.value.unshift(response.data);
  //   $('#createCategory').modal('hide');
  //   resetForm();
  // })
};

const deleteAssociate = () =>{

  loadingButtonDelete.value= true;
  axios.delete(`/associates/${userIdBeingDeleted}`)
  .then(()=>{
    associates.value.data = associates.value.data.filter(admin=>admin.id !== userIdBeingDeleted); 
    $('#deleteAssociateModal').modal('hide');

    toastr.success('Associado apagada com sucesso');

  }).catch(()=>{
    toastr.error('Erro ao apagar');
    loadingButtonDelete.value= false;
    $('#deleteAssociateModal').modal('hide');
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
  getAssociateList();
},300));

onMounted(()=>{
     getAssociateList();
})

</script>


<template>
<div v-if="!loadingDiv">
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Membros Associados</h5>
            <p class="mb-0">Usuários Associados: {{ associates.data.length }}</p>
            <!-- <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createCategory">
              Criar Associado 1
            </button> -->
            <div class="d-flex justify-content-between">
              <router-link to="/admin/associates/create"  class="btn btn-primary m-2">
              <i class="ti ti-plus"></i> Criar Associado
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
      <th scope="col">Nome</th>
      <th scope="col">Telefone</th>
      <th scope="col">Email</th>
      <th scope="col">Nível</th>
      <th scope="col">Registrado em</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody v-if="associates.data.length > 0">
    <tr v-for="(associate,index) in associates.data" :key="associate.id">
      <th scope="row">{{ index+1 }}</th>
      <td>{{ associate.name }}</td>
      <td>{{ associate.mobile }}</td>
      <td>{{ associate.email }}</td>
      <td>{{ associate.role.name }}</td>
      <td>{{ moment(associate.created_at).format('DD-MM-YYYY') }}</td>
      <td>
        <router-link :to="'/admin/associates/'+associate.id+'/edit'"><i class="ti ti-edit"></i></router-link>
        <router-link :to="'/admin/associates/'+associate.id"><i class="ti ti-eye"></i></router-link>
        <!-- <a href="#" @click.prevent="confirmAssociateDeletion(associate)"><i class="ti ti-trash"></i></a> -->
      </td>


   
    </tr>
   
   
  </tbody>
  <tbody v-else>
    <tr>
      <td colspan="7" align="center">Nenhum resultado encontrado</td>
    </tr>
  </tbody>
</table>


          </div>
</div>





<!-- Modal -->
<div class="modal fade" id="deleteAssociateModal" tabindex="-1" role="dialog" aria-labelledby="deleteAssociateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAssociateLabel">Confirmar a exclusão do Associado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja realmente apagar este Associado?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
        <button @click.prevent="deleteAssociate" type="button" class="btn btn-danger" :disabled="loadingButtonDelete">
          <div v-if="loadingButtonDelete" class="spinner-border spinner-border-sm" role="status"></div>
          <span v-else>Apagar Associado</span>
          
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