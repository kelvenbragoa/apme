<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';
import {useToastr} from '../../../toastr';

const toastr = useToastr();
const loadingButtonSubmit = ref(false);
const loadingDiv = ref(true);
let manager =ref([]);
const router = useRouter();
let self = this;

const getAdmin = () => {
  axios.get(`/manager-managers/+${router.currentRoute.value.params.id}/edit`)
       .then((response)=>{
        manager.value = response.data;
        loadingDiv.value=false;


       })
}


const schema = yup.object({
  name: yup.string().required(),
   password: yup.string().min(8),
   mobile: yup.number().required().min(9),
   email: yup.string().email().required() 
});


const editAdminFunction = (values, actions) => {
  loadingButtonSubmit.value = true;
  axios.patch('/manager-managers',values).then((response)=>{

    // managers.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    
    actions.resetForm();
    router.push({ path: '/manager/managers' });
    toastr.success('Gestor editado com sucesso');
    
  })
  .catch((error)=>{
    loadingButtonSubmit.value = false;
    toastr.error('Erro ao adicionar');
    if(error.response.data.errors){
       
      actions.setErrors(error.response.data.errors);
    }
  }).finally(()=>{
    loadingButtonSubmit.value = false;
  })
};

onMounted(()=>{
  
  getAdmin();
})
</script>

<template>
  <div v-if="!loadingDiv">
    <router-link to="/manager/managers" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Editar Gestor</h5>
            
            <Form @submit="editAdminFunction" :validation-schema="schema" v-slot="{ errors }">
                    <div class="mb-3">
                        <label for="nameManager" class="form-label">Nome</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.name}" v-model="manager.name"  name="name" id="nameManager" aria-describedby="nameManager"/>
                        <span class="invalid-feedback">{{ errors.name }}</span>
                        <Field type="hidden" class="form-control"  name="id" v-model="manager.id" id="nameManager" aria-describedby="nameManager"/>
                      
                    </div>
                    <div class="mb-3">
                        <label for="mobileManager" class="form-label">Telefone</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.mobile}" v-model="manager.mobile"  name="mobile" id="mobileManager" aria-describedby="mobileManager"/>
                        <span class="invalid-feedback">{{ errors.mobile }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="emailManager" class="form-label">Email</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.email}" v-model="manager.email" readonly name="email" id="emailManager" aria-describedby="emailManager"/>
                        <span class="invalid-feedback">{{ errors.email }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="passwordManager" class="form-label">Palavra passe</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.password}"  name="password" id="passwordManager" aria-describedby="passwordManager"/>
                        <span class="invalid-feedback">{{ errors.password }}</span>
                    </div>
                   
                    <button type="submit" class="btn btn-primary" :disabled="loadingButtonSubmit">
                        <div v-if="loadingButtonSubmit" class="spinner-border spinner-border-sm" role="status"></div>
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