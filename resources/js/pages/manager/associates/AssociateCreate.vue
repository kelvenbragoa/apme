<script setup>

import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import {Form, Field, FieldArray} from 'vee-validate';
import { useRouter } from "vue-router";
import * as yup from 'yup';
import {useToastr} from '../../../toastr';

const loading = ref(false);
const toastr = useToastr();
let provinces =ref([]);
let frequencies =ref([]);
let currentvalue = ref([]);
let economicActivities =ref([]);
const loadingDiv = ref(true);
const schema = yup.object({
  associate_number: yup.string().required(),
  company_name: yup.string().required(),
  address: yup.string().required(),
  accession_date: yup.string().required(),
  mobile: yup.string().required(),
  fax: yup.string().required(),
  email: yup.string().email().required(),
  date_statute: yup.string().required(),
  number_statute: yup.string().required(),
  company_goals: yup.string().required(),
  representative_name: yup.string().required(),
  representative_email: yup.string().email().required(),
  representative_mobile: yup.string().required(),
  representative_cellphone: yup.string().required(),
  representative_role: yup.string().required(),
  nuit: yup.string().required(),
  invoice_name: yup.string().required(),
  invoice_mobile: yup.string().required(),
  invoice_email: yup.string().email().required(),
  user_email: yup.string().email().required(),
  password: yup.string().required().min(8),
  activities: yup.array().of(
    yup.object().shape({
        name: yup.string().required(),
        
      })
  )

});
let self = this;
const router = useRouter();

const createUserAssociateFunction = (values, actions) => {

   
    currentvalue.value = {values,formobjective};

    loading.value = true;

    const arr = Array.from(values)

    console.log(arr)
    console.log(values)
    
    axios.post('/manager-associates',values).then((response)=>{

    // categories.value.unshift(response.data);
    // $('#createCategory').modal('hide');
    actions.resetForm();
    router.push({ path: '/manager/associates' });
    toastr.success('Membro Associado criado com sucesso');
  }).catch((error)=>{
    
    loading.value = false;
    toastr.error('Erro ao adicionar. '+error.response.data.message);
    if(error.response.data.errors){
       
        actions.setErrors(error.response.data.errors);
    }
  }).finally(()=>{
    loading.value = false;
   
    
  })



};



const getProvince = () => {
  axios.get('/global-provinces')
       .then((response)=>{
        provinces.value = response.data.provinces;
        frequencies.value = response.data.frequencies;
        economicActivities.value = response.data.economicActivities;
        loadingDiv.value=false;

       


       })
       .catch((error)=>{
        toastr.error(error);
        router.push({ path: '/manager/associates' });
       })
}

const formobjective = reactive([
    {id: ''}
]);
const addRow = () =>{
    formobjective.push({id:''})
}
const removeRow = (index) =>{
    if(formobjective.length>1){
        formobjective.splice(index,1)
    }
    
}

onMounted(()=>{
    getProvince()
})
</script>

<template>
    <div v-if="!loadingDiv">
    <router-link to="/manager/associates" >
        <i class="ti ti-arrow-left"></i>Voltar
    </router-link>
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Criar Membro Associado</h5>

            <h5 class="card-title fw-semibold mb-4">Informações gerais</h5>
            
            <Form @submit="createUserAssociateFunction" :validation-schema="schema" v-slot="{ errors }">

                    <!-- <div class="mb-3" v-for="item, index in formobjective" :key="item">
                        {{ item }}
                    <div class="row">
                       
                        
                        <div class="col-sm-9">
                            
                        <label for="company_goals" class="form-label">Objectivos da Empresa {{ index+1 }}</label>
                       
                       
                       <select class="form-control" name="activity" required id="" v-model="item.id">
                           <option v-for="activity in economicActivities" :key="activity.id" :value="activity.id">
                               {{activity.name}}
                           </option> 
                          
                       </select>
                       
                        </div>
                       
                        <div class="col-sm-3 pt-4">
                            <button type="button" class="btn btn-danger m-1" @click="removeRow(index)">x</button>
                            <button type="button" class="btn btn-info m-1" @click="addRow">+</button>
                        </div>
                    </div>
                    </div> -->

        

                    
                    <div class="mb-3">
                        <label for="associate_number" class="form-label">Número de Membro</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.associate_number}"  name="associate_number" id="associate_number" aria-describedby="associate_number"/>
                        <span class="invalid-feedback">{{ errors.associate_number }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Nome da Empresa</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.company_name}"  name="company_name" id="company_name" aria-describedby="company_name"/>
                        <span class="invalid-feedback">{{ errors.company_name }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Endereço</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.address}"  name="address" id="address" aria-describedby="address"/>
                        <span class="invalid-feedback">{{ errors.address }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="provinceId" class="form-label">Província</label>
                        <Field as="select" class="form-control" :class="{'is-invalid':errors.province_id}"  name="province_id" id="provinceId" aria-describedby="provinceId">
                          <option value="" disabled>Selecionar</option>
                          <option v-for="province in provinces" :key="province.id" :value="province.id">{{ province.name }}</option>
                        </Field>
                        <span class="invalid-feedback">{{ errors.province_id }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="accession_date" class="form-label">Data da Adesão</label>
                        <Field type="date" class="form-control" :class="{'is-invalid':errors.accession_date}"  name="accession_date" id="accession_date" aria-describedby="accession_date"/>
                        <span class="invalid-feedback">{{ errors.accession_date }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Telefone</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.mobile}"  name="mobile" id="mobile" aria-describedby="mobile"/>
                        <span class="invalid-feedback">{{ errors.mobile }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="fax" class="form-label">Fax</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.fax}"  name="fax" id="fax" aria-describedby="fax"/>
                        <span class="invalid-feedback">{{ errors.fax }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <Field type="email" class="form-control" :class="{'is-invalid':errors.email}"  name="email" id="email" aria-describedby="email"/>
                        <span class="invalid-feedback">{{ errors.email }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="date_statute" class="form-label">Data da publicação dos estatutos no BR</label>
                        <Field type="date" class="form-control" :class="{'is-invalid':errors.date_statute}"  name="date_statute" id="date_statute" aria-describedby="date_statute"/>
                        <span class="invalid-feedback">{{ errors.date_statute }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="number_statute" class="form-label">Número da publicação dos estatutos no BR</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.number_statute}"  name="number_statute" id="number_statute" aria-describedby="number_statute"/>
                        <span class="invalid-feedback">{{ errors.number_statute }}</span>
                    </div>
                    <div class="mb-3">
                        <label for="company_goals" class="form-label">Objectivos da Empresa</label>
                        <Field as="textarea" class="form-control" :class="{'is-invalid':errors.company_goals}"  name="company_goals" id="company_goals" aria-describedby="company_goals"/>
                        <span class="invalid-feedback">{{ errors.company_goals }}</span>
                    </div>
                    <FieldArray class="form-control" name="activities" v-slot="{ fields, push, remove }">
                        <fieldset class="InputGroup" v-for="(field, idx) in fields" :key="field.key">
                            <div class="row">
                            <div class="col-sm-9">
                                <label class="form-label" :for="`name_${idx}`">Objectivos da Empresa {{ idx+1 }}</label>
                                <Field as="select" :id="`name_${idx}`" :name="`activities[${idx}].name`" class="form-control">
                                    <option value="" disabled>Selecionar</option>
                                    <option v-for="activity in economicActivities" :key="activity.id" :value="activity.id">{{ activity.name }}</option>
                                </Field>            
                               
                                <span class="invalid-feedback">{{ errors.activities }}</span>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-danger mt-4" @click="remove(idx>1 ? idx : 0 )">x</button>
                            </div>
                        </div>


                        
                        </fieldset>

                        <button type="button" class="btn btn-info mt-2" @click="push({ name: '' })">Adicionar atividade +</button>
                    </FieldArray>

                   

                    <h5 class="card-title fw-semibold mb-4">Representante da Empresa</h5>

                    <div class="mb-3">
                        <label for="representative_name" class="form-label">Nome</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.representative_name}"  name="representative_name" id="representative_name" aria-describedby="representative_name"/>
                        <span class="invalid-feedback">{{ errors.representative_name }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="representative_email" class="form-label">Email</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.representative_email}"  name="representative_email" id="representative_email" aria-describedby="representative_email"/>
                        <span class="invalid-feedback">{{ errors.representative_email }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="representative_mobile" class="form-label">Telefone Directo</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.representative_mobile}"  name="representative_mobile" id="representative_mobile" aria-describedby="representative_mobile"/>
                        <span class="invalid-feedback">{{ errors.representative_mobile }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="representative_cellphone" class="form-label">Telemóvel</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.representative_cellphone}"  name="representative_cellphone" id="representative_cellphone" aria-describedby="representative_cellphone"/>
                        <span class="invalid-feedback">{{ errors.representative_cellphone }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="representative_role" class="form-label">Posto</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.representative_role}"  name="representative_role" id="representative_role" aria-describedby="representative_role"/>
                        <span class="invalid-feedback">{{ errors.representative_role }}</span>
                    </div>

                    <h5 class="card-title fw-semibold mb-4">Faturação</h5>


                    <div class="mb-3">
                        <label for="nuit" class="form-label">NUIT</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.nuit}"  name="nuit" id="nuit" aria-describedby="nuit"/>
                        <span class="invalid-feedback">{{ errors.nuit }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="invoice_name" class="form-label">Pessoas de Contacto</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.invoice_name}"  name="invoice_name" id="invoice_name" aria-describedby="invoice_name"/>
                        <span class="invalid-feedback">{{ errors.invoice_name }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="invoice_mobile" class="form-label">Telefone</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.invoice_mobile}"  name="invoice_mobile" id="invoice_mobile" aria-describedby="invoice_mobile"/>
                        <span class="invalid-feedback">{{ errors.invoice_mobile }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="invoice_email" class="form-label">Email</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.invoice_email}"  name="invoice_email" id="invoice_email" aria-describedby="invoice_email"/>
                        <span class="invalid-feedback">{{ errors.invoice_email }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="paymentFrequencyId" class="form-label">Periodicidade de pagamento de quotas</label>
                        <Field as="select" class="form-control" :class="{'is-invalid':errors.payment_frequency_id}"  name="payment_frequency_id" id="paymentFrequencyId" aria-describedby="paymentFrequencyId">
                          <option value="" disabled>Selecionar</option>
                          <option v-for="frequency in frequencies" :key="frequency.id" :value="frequency.id">{{ frequency.name }} ( {{ frequency.months }}meses )</option>
                        </Field>
                        <span class="invalid-feedback">{{ errors.payment_frequency_id }}</span>
                    </div>



                    <h5 class="card-title fw-semibold mb-4">Autenticação e Login</h5>
                   
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email</label>
                        <Field type="email" class="form-control" :class="{'is-invalid':errors.user_email}"  name="user_email" id="userEmail" aria-describedby="userEmail"/>
                        <span class="invalid-feedback">{{ errors.user_email }}</span>
                    </div>

                    <div class="mb-3">
                        <label for="userPassowrd" class="form-label">Palavra passe</label>
                        <Field type="text" class="form-control" :class="{'is-invalid':errors.password}"  name="password" id="userPassowrd" aria-describedby="userPassowrd"/>
                        <span class="invalid-feedback">{{ errors.password }}</span>
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