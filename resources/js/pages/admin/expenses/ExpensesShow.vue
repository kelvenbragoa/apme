<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';

let expense =ref([]);
let loading =ref([true]);
const router = useRouter();
let self = this;

const getExpense = () => {
  axios.get(`/expenses/+${router.currentRoute.value.params.id}`)
       .then((response)=>{
        loading.value=false;
        expense.value = response.data;
       }).catch(()=>{
        loading.value=false;
       })
}


const schema = yup.object({
  name: yup.string().required(),
  // password: yup.string().required().min(8),
  // email: yup.string().email().required()
});


const createCategoryFunction = (values, {resetForm}) => {
  axios.post('/categories',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    resetForm();
    router.push({ path: '/admin/categories' })
  })
};

onMounted(()=>{
  
  getExpense();
})
</script>

<template>
    <div v-if="!loading">
        <router-link to="/admin/expenses" >
            <i class="ti ti-arrow-left"></i>Voltar
        </router-link>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Visualizar Despesa</h5>

                <p><strong>Despesa:</strong> {{ expense.name }}</p>
                <p><strong>Valor:</strong> {{ expense.amount }} MT</p>
                <p><strong>Criado por:</strong> {{ expense.user.name }}</p>
                <p><strong>Registrado em:</strong> {{ expense.data }}</p>
                
                <!-- <Form @submit="createCategoryFunction" :validation-schema="schema" v-slot="{ errors }">
                        <div class="mb-3">
                            <label for="nameCategory" class="form-label">Nome da categoria</label>
                            <Field type="text" class="form-control" :class="{'is-invalid':errors.name}" v-model="category.name"  name="name" id="nameCategory" aria-describedby="nameCategory"/>
                            <span class="invalid-feedback">{{ errors.name }}</span>
                            <Field type="hidden" class="form-control"  name="user_id" value="1" id="nameCategory" aria-describedby="nameCategory"/>
                        
                        </div>
                    
                        <button type="submit" class="btn btn-primary">Submit</button>
                </Form> -->
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