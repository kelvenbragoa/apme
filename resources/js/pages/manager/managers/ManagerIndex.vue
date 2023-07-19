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



const managers = ref({'data': []})

let userIdBeingDeleted = ref(null);

const form = reactive({
  name: '',
  user_id:1,
})


 const getManagerList = async (page = 1) => {
  axios.get(`/manager-managers?page=${page}`,
      {
        params:{
          query: searchQuery.value
        }
      }    
      )
       .then((response)=>{
        managers.value = response.data;
        loadingDiv.value=false;
       })
}

const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});

const createCategoryFunction = (values, {resetForm}) => {
  axios.post('/managers',values).then((response)=>{

    categories.value.unshift(response.data);
    $('#createCategory').modal('hide');
    resetForm();
  })
};

const confirmManagerDeletion = (admin) => {

   userIdBeingDeleted = admin.id;
  console.log(userIdBeingDeleted);
  $('#deleteManagerModal').modal('show');
  // axios.post('/categories',values).then((response)=>{

  //   categories.value.unshift(response.data);
  //   $('#createCategory').modal('hide');
  //   resetForm();
  // })
};

const deleteManager = () =>{

  loadingButtonDelete.value= true;
  axios.delete(`/manager-managers/${userIdBeingDeleted}`)
  .then(()=>{
    managers.value.data = managers.value.data.filter(admin=>admin.id !== userIdBeingDeleted); 
    $('#deleteManagerModal').modal('hide');

    toastr.success('Gestor apagada com sucesso');

  }).catch(()=>{
    toastr.error('Erro ao apagar');
    loadingButtonDelete.value= false;
    $('#deleteManagerModal').modal('hide');
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
  getManagerList();
},300));

onMounted(()=>{
     getManagerList();
})

</script>


<template>
<div v-if="!loadingDiv">
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Gestores</h5>
            <p class="mb-0">Usuários Gestores: {{ managers.data.length }}</p>
            <!-- <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createCategory">
              Criar Gestor 1
            </button> -->
            <div class="d-flex justify-content-between">
              <router-link to="/manager/managers/create"  class="btn btn-primary m-2">
              <i class="ti ti-plus"></i> Criar Gestor
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
  <tbody v-if="managers.data.length > 0">
    <tr v-for="(manager,index) in managers.data" :key="manager.id">
      <th scope="row">{{ index+1 }}</th>
      <td>{{ manager.name }}</td>
      <td>{{ manager.mobile }}</td>
      <td>{{ manager.email }}</td>
      <td>{{ manager.role.name }}</td>
      <td>{{ moment(manager.created_at).format('DD-MM-YYYY') }}</td>
      <td>
        <router-link :to="'/manager/managers/'+manager.id+'/edit'"><i class="ti ti-edit"></i></router-link>
        <router-link :to="'/manager/managers/'+manager.id"><i class="ti ti-eye"></i></router-link>
        <a href="#" @click.prevent="confirmManagerDeletion(manager)"><i class="ti ti-trash"></i></a>
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

<Bootstrap4Pagination :data="managers" @pagination-change-page="getManagerList"/>

<!-- Modal -->
<div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="createCategoryLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <Form @submit="createCategoryFunction" :validation-schema="schema" v-slot="{ errors }">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCategoryLabel">Adicionar Gestor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
                    <div class="mb-3">
                      <label for="nameCategory" class="form-label">Nome da Gestor</label>
                      <Field type="text" class="form-control" :class="{'is-invalid':errors.name}"  name="name" id="nameCategory" aria-describedby="nameCategory"/>
                      <span class="invalid-feedback">{{ errors.name }}</span>
                      <Field type="hidden" class="form-control"  name="user_id" value="1" id="nameCategory" aria-describedby="nameCategory"/>
                      
                      <!-- <input v-model="form.name" type="text" class="form-control" name="name" id="nameCategory" aria-describedby="nameCategory"> -->
                      
                      
                    </div>
                   
                    
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        <!-- <button @click="createCategory" type="button" class="btn btn-primary">Save</button> -->
      </div>
    </div>
  </Form>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="deleteManagerModal" tabindex="-1" role="dialog" aria-labelledby="deleteManagerLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteManagerLabel">Confirmar a exclusão da Gestor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja realmente apagar esta Gestor?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
        <button @click.prevent="deleteManager" type="button" class="btn btn-danger" :disabled="loadingButtonDelete">
          <div v-if="loadingButtonDelete" class="spinner-border spinner-border-sm" role="status"></div>
          <span v-else>Apagar Gestor</span>
          
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