<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';
import {useToastr} from '../../../toastr';

const toastr = useToastr();
let admin =ref([]);
const router = useRouter();
let self = this;
const loadingDiv = ref(true);
const loadingButtonSubmit = ref(false);

const getAdmin = () => {
  axios.get(`/admins/+${router.currentRoute.value.params.id}/edit`)
       .then((response)=>{
        admin.value = response.data;
        loadingDiv.value=false;


       })
}


const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});


const editAdminFunction = (values, actions) => {
  loadingButtonSubmit.value = true;
  axios.patch('/admins',values).then((response)=>{

    // admins.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/admins' });
    toastr.success('Administrador editada com sucesso');
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
    <router-link to="/admin/admins" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Editar Administrador</h5>
            
            <Form @submit="editAdminFunction" :validation-schema="schema" v-slot="{ errors }">
                    <div class="mb-3">
                        <label for="nameAdmin" class="form-label">Nome</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.name}" v-model="admin.name"  name="name" id="nameAdmin" aria-describedby="nameAdmin"/>
                        <span class="invalid-feedback">{{ errors.name }}</span>
                        <Field type="hidden" class="form-control"  name="id" v-model="admin.id" id="nameAdmin" aria-describedby="nameAdmin"/>
                      
                    </div>
                    <div class="mb-3">
                        <label for="mobileAdmin" class="form-label">Telefone</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.mobile}" v-model="admin.mobile"  name="mobile" id="mobileAdmin" aria-describedby="mobileAdmin"/>
                        <span class="invalid-feedback">{{ errors.mobile }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="emailAdmin" class="form-label">Email</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.email}" v-model="admin.email" readonly name="email" id="emailAdmin" aria-describedby="emailAdmin"/>
                        <span class="invalid-feedback">{{ errors.email }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="passwordAdmin" class="form-label">Palavra passe</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.password}"  name="password" id="passwordAdmin" aria-describedby="passwordAdmin"/>
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