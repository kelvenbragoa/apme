<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter } from "vue-router";
import * as yup from 'yup';
import {useToastr} from '../../../toastr';

const loading = ref(false);
const toastr = useToastr();
const schema = yup.object({
   name: yup.string().required(),
   password: yup.string().required().min(8),
   mobile: yup.number().required().min(9),
   email: yup.string().email().required()   
});
let self = this;
const router = useRouter();
const createUserAdminFunction = (values, actions) => {

    loading.value = true;
  axios.post('/admins',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/admins' });
    toastr.success('Administrador criado com sucesso');
  }).catch((error)=>{
    loading.value = false;
    toastr.error('Erro ao adicionar');
    if(error.response.data.errors){
       
        actions.setErrors(error.response.data.errors);
    }
  }).finally(()=>{
    loading.value = false;
   
    
  })
//   .catch((error)=>{

//     if(error.response.data.errors){
//         actions.setErrors(error.response.data.errors);
//     }
   
   
//   })
};

// onMounted(()=>{
//     toastr.success('success')
// })
</script>

<template>
    <!-- <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
              <div class="row align-items-center">
                <div class="col-9">
                  <h4 class="fw-semibold mb-8">Usuários Administradores</h4>
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><router-link class="text-muted " to="/admin/dashboard">Painel de Controle</router-link></li>
                      <li class="breadcrumb-item" aria-current="page"><router-link class="text-muted " to="/admin/admins">Usuários Administradores</router-link></li>
                      <li class="breadcrumb-item" aria-current="page">Criar</li>
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
    <router-link to="/admin/admins" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Criar Usuário Administrador</h5>
            
            <Form @submit="createUserAdminFunction" :validation-schema="schema" v-slot="{ errors }">
                    <div class="mb-3">
                        <label for="nameAdmin" class="form-label">Nome</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.name}"  name="name" id="nameAdmin" aria-describedby="nameAdmin"/>
                        <span class="invalid-feedback">{{ errors.name }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="mobileAdmin" class="form-label">Telefone</label>
                        <Field type="number" class="form-control" :class="{'is-invalid':errors.mobile}"  name="mobile" id="mobileAdmin" aria-describedby="mobileAdmin"/>
                        <span class="invalid-feedback">{{ errors.mobile }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="emailAdmin" class="form-label">Email</label>
                        <Field type="email" class="form-control" :class="{'is-invalid':errors.email}"  name="email" id="emailAdmin" aria-describedby="emailAdmin"/>
                        <span class="invalid-feedback">{{ errors.email }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="passwordAdmin" class="form-label">Palavra passe</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.password}"  name="password" id="passwordAdmin" aria-describedby="passwordAdmin"/>
                        <span class="invalid-feedback">{{ errors.password }}</span>
                    </div>
                   
                    <button type="submit" class="btn btn-primary" :disabled="loading">
                        <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
                        <span v-else>Submeter</span>
                        
                    </button>
            </Form>
          </div>
    </div>
</template>