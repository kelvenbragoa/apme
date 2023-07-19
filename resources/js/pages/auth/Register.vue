<script setup>
    import axios from 'axios';
    import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
    import {Form, Field, FieldArray} from 'vee-validate';
    import * as yup from 'yup';
    const form = reactive ({
        email: '',
        password: ''
    });

    const loading = ref(false);
    let provinces =ref([]);
    let frequencies =ref([]);
    let currentvalue = ref([]);
    let economicActivities =ref([]);
    const loadingDiv = ref(true);
    const errorMessage = ref('');
    const schema = yup.object({

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
        router.push({ path: '/' });
       })
}


    const handleSubmit = () => {
      loading.value = true;
      errorMessage.value = '';
        axios.post('/login',form)
        .then((response)=>{
            console.log(response.data.role_id)
            console.log('hello')
            
            if(response.data.role_id == 1){
              window.location.href="/admin/dashboard";
            }

            if(response.data.role_id == 2){
              window.location.href="/manager/dashboard";
            }
            if(response.data.role_id == 3){
              window.location.href="/associate/dashboard";
            }
            // window.location.href="/admin/dashboard";
        })
        .catch((error)=>{

          errorMessage.value = error.response.data.message
          
        })
        .finally(()=>{
          loading.value = false;
        })
    }

    onMounted(()=>{
    getProvince()
})
</script>

<template>
      <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="template/assets/images/logos/logo.png" width="180" alt="">
                </a>
                <p class="text-center">APME - Associção de Pequenas e Médias Empresas</p>
                <div v-if="errorMessage" class="alert alert-danger" role="alert">
                    {{errorMessage}}
                </div>
                
                <Form @submit="handleSubmit" :validation-schema="schema" v-slot="{ errors }">

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
                        <label for="email" class="form-label">Email da Empresa</label>
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

                  <br>

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
                    <label for="exampleInputEmail1" class="form-label">Usuário/Email</label>
                    <input type="email" v-model="form.email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Palavra passe</label>
                    <input v-model="form.password" type="password" class="form-control" id="exampleInputPassword1">
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <!-- <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Remeber this Device
                      </label>
                    </div> -->
                    <a class="text-primary fw-bold" href="#">Esqueceu palavra passe?</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" :disabled="loading">
                    <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
                    <span v-else>Entrar</span>
                     
                    </button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Ja tem uma conta?</p>
                    <a class="text-primary fw-bold ms-2" href="/login">Entre com sua conta</a>
                  </div>
                </Form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>