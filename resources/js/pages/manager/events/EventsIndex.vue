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



const events = ref({'data': []})

let userIdBeingDeleted = ref(null);

const form = reactive({
  name: '',
  user_id:1,
})


 const getEventList = async (page=1) => {
  axios.get(`/manager-events?page=${page}`,
  {
    params: {
      query: searchQuery.value
    }
  })
       .then((response)=>{
        events.value = response.data;
        loadingDiv.value=false;
       })
}

const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});

const createCategoryFunction = (values, {resetForm}) => {
  axios.post('/manager-events',values).then((response)=>{

    categories.value.unshift(response.data);
    $('#createCategory').modal('hide');
    resetForm();
  })
};

const confirmEventDeletion = (event) => {

   userIdBeingDeleted = event.id;
  console.log(userIdBeingDeleted);
  $('#deleteEventModal').modal('show');
  // axios.post('/categories',values).then((response)=>{

  //   categories.value.unshift(response.data);
  //   $('#createCategory').modal('hide');
  //   resetForm();
  // })
};

const deleteEvent = () =>{

  loadingButtonDelete.value= true;
  axios.delete(`/manager-events/${userIdBeingDeleted}`)
  .then(()=>{
    events.value.data = events.value.data.filter(event=>event.id !== userIdBeingDeleted); 
    $('#deleteEventModal').modal('hide');

    toastr.success('Evento apagada com sucesso');

  }).catch(()=>{
    toastr.error('Erro ao apagar');
    loadingButtonDelete.value= false;
    $('#deleteEventModal').modal('hide');
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
  getEventList();
},300));

onMounted(()=>{
     getEventList();
})

</script>


<template>
<div v-if="!loadingDiv">
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Eventos</h5>
            <p class="mb-0">Eventos: {{ events.data.length }}</p>
            <!-- <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createCategory">
              Criar Evento 1
            </button> -->
            <div class="d-flex justify-content-between">
              <router-link to="/manager/events/create"  class="btn btn-primary m-2">
              <i class="ti ti-plus"></i> Criar Evento
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
      <th scope="col">Evento</th>
      <th scope="col">Descrição</th>
      <th scope="col">Local</th>
      <th scope="col">Data</th>
      <th scope="col">Horas</th>
      <th scope="col">Tipo de Evento</th>
      <th scope="col">Registrado por</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody v-if="events.data.length > 0">
    <tr v-for="(event,index) in events.data" :key="event.id">
      <th scope="row">{{ index+1 }}</th>
      <td>{{ event.name }}</td>
      <td>{{ event.description }}</td>
      <td>{{ event.address }}</td>
      <td>{{ event.date }}</td>
      <td>{{ event.time }}</td>
      <td>{{ event.event_type.name }}</td>
      <td>{{ event.user.name }}</td>
      <td>
        <router-link :to="'/manager/events/'+event.id+'/edit'"><i class="ti ti-edit"></i></router-link>
        <router-link :to="'/manager/events/'+event.id"><i class="ti ti-eye"></i></router-link>
        <a href="#" @click.prevent="confirmEventDeletion(event)"><i class="ti ti-trash"></i></a>
      </td>


   
    </tr>
   
   
  </tbody>
  <tbody v-else>
    <tr>
      <td colspan="9" align="center">Nenhum resultado encontrado</td>
    </tr>
  </tbody>
</table>


          </div>
</div>






<!-- Modal -->
<div class="modal fade" id="deleteEventModal" tabindex="-1" role="dialog" aria-labelledby="deleteEventLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteEventLabel">Confirmar a exclusão do Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Deseja realmente apagar este Evento?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
        <button @click.prevent="deleteEvent" type="button" class="btn btn-danger" :disabled="loadingButtonDelete">
          <div v-if="loadingButtonDelete" class="spinner-border spinner-border-sm" role="status"></div>
          <span v-else>Apagar Evento</span>
          
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