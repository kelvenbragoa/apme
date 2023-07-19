<script setup>
import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import * as yup from 'yup';

import {useToastr} from '../../../toastr';


const toastr = useToastr();

const loadingDiv = ref(true);
const loadingButtonDelete = ref(false);



const activities = ref([])

let userIdBeingDeleted = ref(null);

const form = reactive({
  name: '',
  user_id:1,
})


 const getActivityList = async () => {
  axios.get('/activities')
       .then((response)=>{
        activities.value = response.data;
        loadingDiv.value=false;
       })
}

const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});

const createCategoryFunction = (values, {resetForm}) => {
  axios.post('/activities',values).then((response)=>{

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
  axios.delete(`/activities/${userIdBeingDeleted}`)
  .then(()=>{
    activities.value = activities.value.filter(event=>event.id !== userIdBeingDeleted); 
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

onMounted(()=>{
     getActivityList();
})

</script>


<template>
<div v-if="!loadingDiv">
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Eventos</h5>
            <p class="mb-0">Eventos: {{ activities.length }}</p>
            <!-- <button type="button" class="btn btn-primary m-2" data-toggle="modal" data-target="#createCategory">
              Criar Evento 1
            </button> -->
            <router-link to="/admin/activity/create"  class="btn btn-primary m-2">
              <i class="ti ti-plus"></i> Criar Evento
            </router-link>
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
  <tbody>
    <tr v-for="(event,index) in activities" :key="event.id">
      <th scope="row">{{ index+1 }}</th>
      <td>{{ event.name }}</td>
      <td>{{ event.description }}</td>
      <td>{{ event.address }}</td>
      <td>{{ event.date }}</td>
      <td>{{ event.time }}</td>
      <td>{{ event.event_type }}</td>
      <td>{{ event.user }}</td>
      <td>
        <router-link :to="'/admin/activities/'+event.id+'/edit'"><i class="ti ti-edit"></i></router-link>
        <router-link :to="'/admin/activities/'+event.id"><i class="ti ti-eye"></i></router-link>
        <a href="#" @click.prevent="confirmEventDeletion(event)"><i class="ti ti-trash"></i></a>
      </td>


   
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