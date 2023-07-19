<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field} from 'vee-validate';
import { useRouter} from "vue-router";
import * as yup from 'yup';

let associate =ref([]);
let loading =ref([true]);
const router = useRouter();
let self = this;
let activityassociate =ref([]);

const getAssociate = () => {
  axios.get(`/associate-associates/+${router.currentRoute.value.params.id}`)
       .then((response)=>{
        loading.value=false;
        associate.value = response.data.associate;
        activityassociate.value = response.data.activity;
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
  axios.post('/associate-associates',values).then((response)=>{

    // associates.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    resetForm();
    router.push({ path: '/associate/associates' })
  })
};

onMounted(()=>{
  
  getAssociate();
})
</script>

<template>
    <div v-if="!loading">
       
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Associado</h5>
                <router-link to="/associate/associates/edit"  class="btn btn-primary m-2">
                <i class="ti ti-edit"></i> Editar
                </router-link>
                <h5>Informações de autenticação da conta</h5>
                
                <p><strong>Nome :</strong> {{ associate.name }}</p>
                <p><strong>Telefone :</strong> {{ associate.mobile }}</p>
                <p><strong>Email :</strong> {{ associate.email }}</p>
                <p><strong>Nível :</strong> {{ associate.role.name }}</p>

                <hr>
                <h5>Informações da empresa</h5>
                <p><strong>Número do Membro :</strong> {{ associate.associatecompany.associate_number }}</p>
                <p><strong>Nome da Empresa :</strong> {{ associate.associatecompany.company_name }}</p>
                <p><strong>Endereço :</strong> {{ associate.associatecompany.address }}</p>
                <p><strong>Província :</strong> {{ associate.associatecompany.province.name }}</p>
                <p><strong>Data da Adesão :</strong> {{ associate.associatecompany.accession_date }}</p>
                <p><strong>Telefone :</strong> {{ associate.associatecompany.mobile }}</p>
                <p><strong>Fax :</strong> {{ associate.associatecompany.fax }}</p>
                <p><strong>Email :</strong> {{ associate.associatecompany.email }}</p>
                <p><strong>Data da publicação dos estatutos no BR :</strong> {{ associate.associatecompany.date_statute }}</p>
                <p><strong>Número da publicação dos estatutos no BR :</strong> {{ associate.associatecompany.number_statute }}</p>
                <p><strong>Objectivos da empresa :</strong> {{ associate.associatecompany.company_goals }}</p>
                <hr>

                <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Atividade comercial</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(act,index) in activityassociate" :key="act.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{act.activity.name}}</td>
                            </tr>
                        </tbody>
                    </table>

                <hr>
                <h5>Representante da empresa</h5>
                <p><strong>Nome :</strong> {{ associate.associatecompany.representative_name }}</p>
                <p><strong>Email :</strong> {{ associate.associatecompany.representative_email }}</p>
                <p><strong>Telefone Direto :</strong> {{ associate.associatecompany.representative_mobile }}</p>
                <p><strong>Telemóvel :</strong> {{ associate.associatecompany.representative_cellphone }}</p>
                <p><strong>Posto :</strong> {{ associate.associatecompany.representative_role }}</p>

                <hr>
                <h5>Faturação</h5>
                <p><strong>NUIT :</strong> {{ associate.associatecompany.nuit }}</p>
                <p><strong>Pessoas de contacto :</strong> {{ associate.associatecompany.invoice_name }}</p>
                <p><strong>Telefone :</strong> {{ associate.associatecompany.invoice_mobile }}</p>
                <p><strong>Email :</strong> {{ associate.associatecompany.invoice_email }}</p>
                <p><strong>Periodicidade de Pagamento :</strong> {{ associate.associatecompany.frequency.name }} ( {{ associate.associatecompany.frequency.months }} meses)</p>
                


                
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