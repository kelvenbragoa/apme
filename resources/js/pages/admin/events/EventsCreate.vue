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
   description: yup.string().required(),
   address: yup.string().required(),
   time: yup.string().required(),
   date: yup.date().required(),
   event_type_id: yup.string().required(),
   
});
let self = this;
const router = useRouter();
const createEventFunction = (values, actions) => {

    loading.value = true;
  axios.post('/events',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/admin/events' });
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

// onMounted(()=>{
//     toastr.success('success')
// })
</script>

<template>
    <router-link to="/admin/events" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Criar Evento</h5>
            
            <Form @submit="createEventFunction" :validation-schema="schema" v-slot="{ errors }">
                    <div class="mb-3">
                        <label for="nameEvent" class="form-label">Evento</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.name}"  name="name" id="nameEvent" aria-describedby="nameEvent"/>
                        <span class="invalid-feedback">{{ errors.name }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="descriptionEvent" class="form-label">Descrição</label>
                        <Field as="textarea" class="form-control" :class="{'is-invalid':errors.description}"  name="description" id="descriptionEvent" aria-describedby="descriptionEvent"/>
                        <span class="invalid-feedback">{{ errors.description }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="addressEvent" class="form-label">Local</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.address}"  name="address" id="addressEvent" aria-describedby="addressEvent"/>
                        <span class="invalid-feedback">{{ errors.address }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="dateEvent" class="form-label">Data</label>
                        <Field type="date" class="form-control" :class="{'is-invalid':errors.date}"  name="date" id="dateEvent" aria-describedby="dateEvent"/>
                        <span class="invalid-feedback">{{ errors.date }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="timeEvent" class="form-label">Horas</label>
                        <Field type="time" class="form-control" :class="{'is-invalid':errors.time}"  name="time" id="timeEvent" aria-describedby="timeEvent"/>
                        <span class="invalid-feedback">{{ errors.time }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="typeEvent" class="form-label">Tipo de Evento</label>
                        <Field as="select" class="form-control" :class="{'is-invalid':errors.event_type_id}"  name="event_type_id" id="typeEvent">
                          <option value="" disabled>Selecione</option>
                          <option value="2" >Público</option>
                          <option value="1">Privado</option>
                        </Field>
                        <span class="invalid-feedback">{{ errors.event_type_id }}</span>
                    </div>

                 
                   
                    <button type="submit" class="btn btn-primary" :disabled="loading">
                        <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
                        <span v-else>Submeter</span>
                    </button>
            </Form>
          </div>
    </div>
</template>