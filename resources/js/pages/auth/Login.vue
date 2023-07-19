<script setup>
    import axios from 'axios';
    import {reactive, ref} from 'vue';


    const form = reactive ({
        email: '',
        password: ''
    });

    const loading = ref(false);

    const errorMessage = ref('');
    


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
</script>

<template>
      <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
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
                
                <form @submit.prevent="handleSubmit">
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
                    <a class="text-primary fw-bold" href="#">Esqueceu palavra passe? Contacte o administrador</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" :disabled="loading">
                    <div v-if="loading" class="spinner-border spinner-border-sm" role="status"></div>
                    <span v-else>Entrar</span>
                     
                    </button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Novo na APME?</p>
                    <a href="#">Contacte para aceder ao sistema.</a>
                    <!-- <a class="text-primary fw-bold ms-2" href="/register">Criar uma nova conta</a> -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>