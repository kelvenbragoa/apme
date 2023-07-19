<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter } from "vue-router";
import * as yup from 'yup';
import {useToastr} from '../../../toastr';

const loading = ref(false);
const toastr = useToastr();
const classes = ref([]);
const loadingDiv = ref(true);
const schema = yup.object({
  //  name: yup.string().required(),
  //  description: yup.string().required(),
  //  address: yup.string().required(),
  //  time: yup.string().required(),
  //  date: yup.date().required(),
  //  event_type_id: yup.string().required(),
   
});
let self = this;
const router = useRouter();
const getData = ()=>{
  axios.get('/getactivities')
       .then((response)=>{
        classes.value = response.data.class;
       

        loadingDiv.value=false;


       })
}
const createEventFunction = (values, actions) => {

    loading.value = true;
  axios.post('/activities',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/activity' });
    toastr.success('Evento criado com sucesso');
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

onMounted(()=>{
    getData();
})
</script>

<template>
  <div v-if="!loadingDiv">
    <router-link to="/admin/activity" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Criar Evento</h5>
            
            <Form @submit="createEventFunction" :validation-schema="schema" v-slot="{ errors }">
              <div class="mb-3">
                        <label for="class_economic_activity_id" class="form-label">Classe</label>
                        <Field as="select" class="form-control" :class="{'is-invalid':errors.class_economic_activity_id}"  name="class_economic_activity_id" id="class_economic_activity_id" aria-describedby="class_economic_activity_id">
                          <option value="" disabled>Selecionar</option>
                          <option v-for="clas in classes" :key="clas" :value="clas.id">{{ clas.name }}</option>
                        </Field>
                          <span class="invalid-feedback">{{ errors.class_economic_activity_id }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="nameEvent" class="form-label">Subclass</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.name}"  name="name" id="nameEvent" aria-describedby="nameEvent"/>
                        <span class="invalid-feedback">{{ errors.name }}</span>
                    </div>


                 
                   
                    <button type="submit" class="btn btn-primary" :disabled="loading">
                        <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
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