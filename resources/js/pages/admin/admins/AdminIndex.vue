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



const admins = ref({'data': []})

let userIdBeingDeleted = ref(null);

const form = reactive({
  name: '',
  user_id:1,
})


 const getAdminList = async (page = 1) => {
  axios.get(`/admins?page=${page}`,
      {
        params:{
          query: searchQuery.value
        }
      })
       .then((response)=>{
        admins.value = response.data;
        loadingDiv.value=false;
       })
}

const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});

const createCategoryFunction = (values, {resetForm}) => {
  axios.post('/admins',values).then((response)=>{

    categories.value.unshift(response.data);
    $('#createCategory').modal('hide');
    resetForm();
  })
};

const confirmAdminDeletion = (admin) => {

   userIdBeingDeleted = admin.id;
  console.log(userIdBeingDeleted);
  $('#deleteAdminModal').modal('show');
  // axios.post('/categories',values).then((response)=>{

  //   categories.value.unshift(response.data);
  //   $('#createCategory').modal('hide');
  //   resetForm();
  // })
};

const deleteAdmin = () =>{

  loadingButtonDelete.value= true;

  axios.delete(`/admins/${userIdBeingDeleted}`)
  .then(()=>{
    admins.value.data = admins.value.data.filter(admin=>admin.id !== userIdBeingDeleted); 
    $('#deleteAdminModal').modal('hide');

    toastr.success('Administrador apagada com sucesso');

  }).catch(()=>{
    toastr.error('Erro ao apagar');
    loadingButtonDelete.value= false;
    $('#deleteAdminModal').modal('hide');
  }).finally(()=>{
    loadingButtonDelete.value= false;
  });
}



const search = () => {
  
  axios.get('/admin/search',{
    params:{
      query: searchQuery.value
    }
  }).then((response)=>{
    admins.value = response.data;

  }).catch((error)=>{
    console.log(error)
  })
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
  getAdminList();
},300));

onMounted(()=>{
     getAdminList();
})

</script>


<template>
<div v-if="!loadingDiv">
  <!-- <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8">Usuários Administradores</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><router-link class="text-muted " to="/admin/dashboard">Painel de Controle</router-link></li>
                      <li class="breadcrumb-item" aria-current="page">Usuários Administradores</li>
                    </ol>
                  </nav>
                </div>
                <div class="col-3">
                  <div class="text-center mb-n5">  
                    <img src="" alt="" class="img-fluid mb-n4">
                  </div>
                </div>
              </div>
            </div>
          </div> -->
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Administradores</h5>
            <p class="mb-0">Usuários administradores: {{ admins.data.length }}</p>
            <!-- <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createCategory">
              Criar Administrador 1
            </button> -->
           <div class="d-flex justify-content-between">
              <router-link to="/admin/admins/create"  class="btn btn-primary m-2">
                <i class="ti ti-plus"></i> Criar Administrador
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
  <tbody v-if="admins.data.length > 0">
    <tr v-for="(admin,index) in admins.data" :key="admin.id">
      <th scope="row">{{ index+1 }}</th>
      <td>{{ admin.name }}</td>
      <td>{{ admin.mobile }}</td>
      <td>{{ admin.email }}</td>
      <td>{{ admin.role.name }}</td>
      <td>{{ moment(admin.created_at).format('DD-MM-YYYY') }}</td>
      <td>
        <router-link :to="'/admin/admins/'+admin.id+'/edit'"><i class="ti ti-edit"></i></router-link>
        <router-link :to="'/admin/admins/'+admin.id"><i class="ti ti-eye"></i></router-link>
        <a href="#" @click.prevent="confirmAdminDeletion(admin)"><i class="ti ti-trash"></i></a>
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
<Bootstrap4Pagination :data="admins" @pagination-change-page="getAdminList"/>

<!-- Modal -->
<div class="modal fade" id="createCategory" tabindex="-1" role="dialog" aria-labelledby="createCategoryLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <Form @submit="createCategoryFunction" :validation-schema="schema" v-slot="{ errors }">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCategoryLabel">Adicionar Administrador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       
                    <div class="mb-3">
                      <label for="nameCategory" class="form-label">Nome da Administrador</label>
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
<div class="modal fade" id="deleteAdminModal" tabindex="-1" role="dialog" aria-labelledby="deleteAdminLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAdminLabel">Confirmar a exclusão da Administrador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja realmente apagar esta Administrador?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button @click.prevent="deleteAdmin" type="button" class="btn btn-danger" :disabled="loadingButtonDelete">
          <div v-if="loadingButtonDelete" class="spinner-border spinner-border-sm" role="status"></div>
          <span v-else>Apagar Administrador</span>
          
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