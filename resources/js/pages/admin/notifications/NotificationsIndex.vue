<script setup>
import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import * as yup from 'yup';

import {useToastr} from '../../../toastr';


const toastr = useToastr();

const loadingDiv = ref(true);
const loadingButtonDelete = ref(false);



const notifications = ref([])

let userIdBeingDeleted = ref(null);

const form = reactive({
  name: '',
  user_id:1,
})


 const getNotificationList = async () => {
  axios.get('/notifications')
       .then((response)=>{
        notifications.value = response.data;
        loadingDiv.value=false;
       })
}

const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});

const createCategoryFunction = (values, {resetForm}) => {
  axios.post('/notifications',values).then((response)=>{

    categories.value.unshift(response.data);
    $('#createCategory').modal('hide');
    resetForm();
  })
};

const confirmNotificationDeletion = (event) => {

   userIdBeingDeleted = event.id;
  console.log(userIdBeingDeleted);
  $('#deleteNotificationModal').modal('show');
  // axios.post('/categories',values).then((response)=>{

  //   categories.value.unshift(response.data);
  //   $('#createCategory').modal('hide');
  //   resetForm();
  // })
};

const deleteNotification = () =>{

  loadingButtonDelete.value= true;
  axios.delete(`/notifications/${userIdBeingDeleted}`)
  .then(()=>{
    notifications.value = notifications.value.filter(event=>event.id !== userIdBeingDeleted); 
    $('#deleteNotificationModal').modal('hide');

    toastr.success('Evento apagada com sucesso');

  }).catch(()=>{
    toastr.error('Erro ao apagar');
    loadingButtonDelete.value= false;
    $('#deleteNotificationModal').modal('hide');
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
     getNotificationList();
})

</script>


<template>
<div v-if="!loadingDiv">
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Notificações</h5>
           
          
           <div v-if="notifications.length>0">
            <div class="card" v-for="(notification,index) in notifications" :key="notification.id">
                <div class="card-body">
                 
                  <p class="mb-0"><strong> {{ index+1 }}.</strong> {{notification.data.data}} </p>
                  <strong><p class="mb-0">{{notification.created_at}} </p></strong> 
                </div>
            </div>
          </div>
            <div v-else>
            <div class="card">
              <div class="card-body">
                <p>Nenhuma notificação</p>
              </div>
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