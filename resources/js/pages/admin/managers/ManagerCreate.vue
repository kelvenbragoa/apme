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
const createUserManagerFunction = (values, actions) => {

    loading.value = true;
  axios.post('/managers',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/managers' });
    toastr.success('Gestor criado com sucesso');
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
    <router-link to="/admin/managers" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Criar Usuário Gestor</h5>
            
            <Form @submit="createUserManagerFunction" :validation-schema="schema" v-slot="{ errors }">
                    <div class="mb-3">
                        <label for="nameManager" class="form-label">Nome</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.name}"  name="name" id="nameManager" aria-describedby="nameManager"/>
                        <span class="invalid-feedback">{{ errors.name }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="mobileManager" class="form-label">Telefone</label>
                        <Field type="number" class="form-control" :class="{'is-invalid':errors.mobile}"  name="mobile" id="mobileManager" aria-describedby="mobileManager"/>
                        <span class="invalid-feedback">{{ errors.mobile }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="emailManager" class="form-label">Email</label>
                        <Field type="email" class="form-control" :class="{'is-invalid':errors.email}"  name="email" id="emailManager" aria-describedby="emailManager"/>
                        <span class="invalid-feedback">{{ errors.email }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="passwordManager" class="form-label">Palavra passe</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.password}"  name="password" id="passwordManager" aria-describedby="passwordManager"/>
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