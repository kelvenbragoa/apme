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
let event =ref([]);
let type_event =ref([]);
const router = useRouter();
let self = this;

const getEvent = () => {
  axios.get(`/events/+${router.currentRoute.value.params.id}/edit`)
       .then((response)=>{
        event.value = response.data.event;
        type_event.value = response.data.type_event;
        loadingDiv.value=false;


       })
}


const schema = yup.object({
  name: yup.string().required(),
   description: yup.string().required(),
   address: yup.string().required(),
   time: yup.string().required(),
   date: yup.date().required(),
   event_type_id: yup.string().required(),
});


const editEventFunction = (values, actions) => {
  loadingButtonSubmit.value = true;
  axios.patch('/events',values).then((response)=>{

    // events.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    
    actions.resetForm();
    router.push({ path: '/admin/events' });
    toastr.success('Evento editada com sucesso');
    
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
  
  getEvent();
})
</script>

<template>
  <div v-if="!loadingDiv">
    <router-link to="/admin/events" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Editar Evento</h5>
            
            <Form @submit="editEventFunction" :validation-schema="schema" v-slot="{ errors }">
                    <div class="mb-3">
                        <label for="nameEvent" class="form-label">Nome</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.name}" v-model="event.name"  name="name" id="nameEvent" aria-describedby="nameEvent"/>
                        <span class="invalid-feedback">{{ errors.name }}</span>
                        <Field type="hidden" class="form-control" :class="{'is-invalid':errors.id}" v-model="event.id"  name="id" id="idEvent" aria-describedby="idEvent"/>
                        
                      
                    </div>

                    <div class="mb-3">
                        <label for="descriptionEvent" class="form-label">Descrição</label>
                        <Field as="textarea" class="form-control" :class="{'is-invalid':errors.description}" v-model="event.description"  name="description" id="descriptionEvent" aria-describedby="descriptionEvent"/>
                        <span class="invalid-feedback">{{ errors.description }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="addressEvent" class="form-label">Local</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.address}" v-model="event.address"  name="address" id="addressEvent" aria-describedby="addressEvent"/>
                        <span class="invalid-feedback">{{ errors.address }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="dateEvent" class="form-label">Data</label>
                        <Field type="date" class="form-control" :class="{'is-invalid':errors.date}" v-model="event.date" name="date" id="dateEvent" aria-describedby="dateEvent"/>
                        <span class="invalid-feedback">{{ errors.date }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="timeEvent" class="form-label">Horas</label>
                        <Field type="time" class="form-control" :class="{'is-invalid':errors.time}" v-mode="event.time" name="time" id="timeEvent" aria-describedby="timeEvent"/>
                        <span class="invalid-feedback">{{ errors.time }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="typeEvent" class="form-label">Tipo de Evento</label>
                        <!-- <Field as="select" v-slot="{ value }" class="form-control" :class="{'is-invalid':errors.event_type_id}"  name="event_type_id" id="typeEvent" aria-describedby="typeEvent">
                          <option value="" disabled>Selecionar</option>
                          <option v-for="t in type_event" :key="t" :value="t" :selected="value && value.includes(t)">{{ t.name }}</option>
                          <option value="2">Público</option>
                          <option value="1">Privado</option> 
                        </Field> -->
                        <Field as="select" class="form-control" :class="{'is-invalid':errors.event_type_id}" v-model="event.event_type_id"  name="event_type_id" id="typeEvent">
                          <option value="" disabled>Selecione</option>
                          <option value="2" >Público</option>
                          <option value="1">Privado</option>
                        </Field>
                        <span class="invalid-feedback">{{ errors.event_type_id }}</span>
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