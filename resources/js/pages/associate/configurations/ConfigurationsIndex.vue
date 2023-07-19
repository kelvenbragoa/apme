<script setup>
import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import * as yup from 'yup';

import {useToastr} from '../../../toastr';


const toastr = useToastr();

const loadingDiv = ref(true);
const loadingButtonSubmit = ref(false);
const loadingButtonDelete = ref(false);
const errorMessage = ref('');


const configurations = ref([])

let userIdBeingDeleted = ref(null);

const form = reactive({
  name: '',
  user_id:1,
})


 const getConfigurationList = async () => {
  axios.get('/associate-configurations')
       .then((response)=>{
        configurations.value = response.data;
        loadingDiv.value=false;
       })
}

const schema = yup.object({
  // name: yup.string().required(),
  current_password: yup.string().required().min(8),
   new_password: yup.string().required().min(8),
   new_confirm_password: yup.string().required().min(8),
  // email: yup.string().email().required()
});

const createCategoryFunction = (values, {resetForm}) => {
  axios.post('/associate-configurations',values).then((response)=>{

    categories.value.unshift(response.data);
    $('#createCategory').modal('hide');
    resetForm();
  })
};

const confirmConfigurationDeletion = (event) => {

   userIdBeingDeleted = event.id;
  console.log(userIdBeingDeleted);
  $('#deleteConfigurationModal').modal('show');
  // axios.post('/categories',values).then((response)=>{

  //   categories.value.unshift(response.data);
  //   $('#createCategory').modal('hide');
  //   resetForm();
  // })
};

const deleteNotification = () =>{

  loadingButtonDelete.value= true;
  axios.delete(`/associate-configurations/${userIdBeingDeleted}`)
  .then(()=>{
    configurations.value = configurations.value.filter(event=>event.id !== userIdBeingDeleted); 
    $('#deleteConfigurationModal').modal('hide');

    toastr.success('Configuração apagada com sucesso');

  }).catch(()=>{
    toastr.error('Erro ao apagar');
    loadingButtonDelete.value= false;
    $('#deleteConfigurationModal').modal('hide');
  }).finally(()=>{
    loadingButtonDelete.value= false;
  });
}

const editConfigurationFunction = (values, actions) => {
  console.log('hello')
  loadingButtonSubmit.value = true;
  errorMessage.value = '';
  axios.post('/associate-changepassword',values).then((response)=>{

    // events.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    
    actions.resetForm();
    toastr.success('Password editada com sucesso');
    
  })
  .catch((error)=>{

    loadingButtonSubmit.value = false;
    errorMessage.value = error.response.data.message
    toastr.error('Erro ao editar a Password');
    if(error.response.data.errors){
       
      actions.setErrors(error.response.data.errors);
    }
  }).finally(()=>{
    loadingButtonSubmit.value = false;
  })
};
// const createCategory = () => {
//   axios.post('/categories',form)
//   .then((response)=>{
//     categories.value.unshift(response.data);
//     form.name ='';
    
    
//     $('#createCategory').modal('hide');
//   });
// }

onMounted(()=>{
     getConfigurationList();
})

</script>


<template>
<div v-if="!loadingDiv">
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Configurações {{ configurations.name }}</h5>
           
          
           
            <div class="card">
              <div class="card-body">
                  <Form :validation-schema="schema">
                    <div class="mb-3">
                        <label for="nameConfiguration" class="form-label">Nome</label>
                        <Field type="text" class="form-control" v-model="configurations.name" readonly name="name" id="nameConfiguration" aria-describedby="nameConfiguration"/>
                        
                       
                    </div>

                    <div class="mb-3">
                        <label for="nameConfiguration" class="form-label">Email</label>
                        <Field type="email" class="form-control" v-model="configurations.email" readonly name="email" id="emailConfiguration" aria-describedby="emailConfiguration"/>
                        
                    </div>
                    <div class="mb-3">
                        <label for="nameConfiguration" class="form-label">Telefone</label>
                        <Field type="text" class="form-control" v-model="configurations.mobile" readonly name="mobile" id="mobileConfiguration" aria-describedby="mobileConfiguration"/>
                        
                    </div>
                    
                   
                  </Form>
                </div>
                <div class="card-body">
                  <div v-if="errorMessage" class="alert alert-danger" role="alert">
                    {{errorMessage}}
                  </div>
                  <Form @submit="editConfigurationFunction" :validation-schema="schema" v-slot="{ errors }">

                    <div class="mb-3">
                        <label for="currentPasswordConfiguration" class="form-label">Palavra passe atual</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.current_password}" name="current_password" id="currentPasswordConfiguration" aria-describedby="currentPasswordConfiguration"/>
                        <span class="invalid-feedback">{{ errors.current_password }}</span>
                        <Field type="hidden" class="form-control" :class="{'is-invalid':errors.id}" v-model="configurations.id"  name="id" id="idConfiguration" aria-describedby="idConfiguration"/>
                    </div>

                    <div class="mb-3">
                        <label for="newPasswordConfiguration" class="form-label">Nova palavra passe</label>
                        <Field type="email" class="form-control" :class="{'is-invalid':errors.new_password}"  name="new_password" id="newPasswordConfiguration" aria-describedby="newPasswordConfiguration"/>
                        <span class="invalid-feedback">{{ errors.new_password }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="newConfirmPasswordConfiguration" class="form-label">Confirmar nova palavra passe</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.new_confirm_password}"  name="new_confirm_password" id="newConfirmPasswordConfiguration" aria-describedby="newConfirmPasswordConfiguration"/>
                        <span class="invalid-feedback">{{ errors.new_confirm_password }}</span>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" :disabled="loadingButtonSubmit">
                        <div v-if="loadingButtonSubmit" class="spinner-border spinner-border-sm" role="status"></div>
                        <span v-else>Submeter</span>
                        
                    </button>
                  </Form>
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