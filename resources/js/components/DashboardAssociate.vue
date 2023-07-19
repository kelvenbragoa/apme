<script setup>

  import {onMounted, ref, reactive} from 'vue';
  import FullCalendar from '@fullcalendar/vue3'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import interactionPlugin from '@fullcalendar/interaction'
  import timeGridPlugin from '@fullcalendar/timegrid'
  const loadingDiv = ref(true);
  const expenses = ref([])
  const quotes = ref([])
  const user_data = ref([]);
  const selectedAdminStatus = ref('total');
  const totalAdminCount = ref(0);
  const status = ref(0);

  const selectedManagerStatus = ref('total');
  const totalManagerCount = ref(0);

  const selectedAssociateStatus = ref('total');
  const totalAssociateCount = ref(0);

  const selectedUserStatus = ref('total');
  const totalUserCount = ref(0);

  const selectedExpenseStatus = ref('total');
  const totalExpenseCount = ref(0);
  const totalExpenseAmount = ref(0);

  const selectedQuoteStatus = ref('total');
  const totalQuoteCount = ref(0);
  const totalQuoteAmount = ref(0);

  const calendarOptions =  reactive({
        plugins: [ dayGridPlugin, interactionPlugin ,timeGridPlugin],
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events:"",
        initialView: 'dayGridMonth'
      })

  const getAdminCount = ()=>{
    axios.get('/associate/dashboard/index',{
      params: {
        date_range: selectedAdminStatus.value
      }
    })
    .then((response)=>{
      totalAdminCount.value = response.data.totalAdminCount;
    })
  }

  const getManagerCount = ()=>{
    axios.get('/manager/dashboard/managercount',{
      params: {
        date_range: selectedManagerStatus.value
      }
    })
    .then((response)=>{
      totalManagerCount.value = response.data.totalManagerCount;
    })
  }

  const getAssociateCount = ()=>{
    axios.get('/manager/dashboard/associatecount',{
      params: {
        date_range: selectedAssociateStatus.value
      }
    })
    .then((response)=>{
      totalAssociateCount.value = response.data.totalAssociateCount;
    })
  }

  const getUserCount = ()=>{
    axios.get('/manager/dashboard/usercount',{
      params: {
        date_range: selectedUserStatus.value
      }
    })
    .then((response)=>{
      totalUserCount.value = response.data.totalUserCount;
    })
  }

  const getExpenseCount = ()=>{
    axios.get('/manager/dashboard/expensecount',{
      params: {
        date_range: selectedExpenseStatus.value
      }
    })
    .then((response)=>{
      totalExpenseCount.value = response.data.totalExpenseCount;
      totalExpenseAmount.value = response.data.totalExpenseAmount;
    })
  }

  const getQuoteCount = ()=>{
    axios.get('/manager/dashboard/quotecount',{
      params: {
        date_range: selectedQuoteStatus.value
      }
    })
    .then((response)=>{
      totalQuoteCount.value = response.data.totalQuoteCount;
      totalQuoteAmount.value = response.data.totalQuoteAmount;
    })
  }

  const getAllCount = ()=>{

    axios.get('/associate/dashboard/index')
    .then((response)=>{
      user_data.value = response.data.user_info;
      quotes.value = response.data.last10quotes;
      calendarOptions.events = response.data.events;
      status.value = response.data.status;
      loadingDiv.value=false;
    })

  }

  onMounted(()=>{
    getAllCount();
})
</script>


<template>
<div v-if="!loadingDiv">

            <h5 class="card-title fw-semibold mb-4">Painel de Controle</h5>
            <p class="mb-0">Painel do Associado </p>


            <div class="row mt-3">

              <div class="col-lg-3">
                <div class="card">
                      <div class="card-body">
                        <div class="row alig n-items-start">
                          <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Associado </h5>
                            <h4 class="fw-semibold mb-3">{{ user_data.name }}</h4>
                            <div class="d-flex align-items-center pb-1">
                              <span
                                class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-calendar text-danger"></i>
                              </span>
                              <!-- <select name="date_range" @change="getManagerCount()" v-model="selectedManagerStatus" class="form-control">
                                <option selected value="total" >Total</option>
                                <option value="today" >Hoje</option>
                                <option value="30" >30 dias</option>
                                <option value="60" >60 dias</option>
                                <option value="360" >360 dias</option>
                                <option value="monthtodate" >Inicio Mês até Hoje</option>
                                <option value="yeartodate" >Inicio Ano até Hoje</option>
                             </select> -->
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="d-flex justify-content-end">
                              <div
                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="ti ti-users fs-6"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <router-link class="sidebar-link" to="/associate/associates" aria-expanded="false">
                        <div class="card-footer">
                          <div class="d-flex justify-content-between">
                            <span>Ver Informação</span>
                            <i class="ti ti-arrow-right fs-6"></i>
                          </div>
                        </div>
                      </router-link>
                </div>
              </div>

              
              <div class="col-lg-3">
                <div class="card">
                      <div class="card-body">
                        <div class="row alig n-items-start">
                          <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Situação </h5>
                            <h4 class="fw-semibold mb-3 text-success" v-if="status == 1">Regular</h4>
                            <h4 class="fw-semibold mb-3 text-danger" v-else>Irregular</h4>
                            <div class="d-flex align-items-center pb-1">
                              <span
                                class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-activity text-danger"></i>
                              </span>
                             
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="d-flex justify-content-end">
                              <div
                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="ti ti-activity fs-6"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <router-link class="sidebar-link" to="/associate/quotes" aria-expanded="false">
                        <div class="card-footer">
                          <div class="d-flex justify-content-between">
                            <span>Ver Quotas</span>
                            <i class="ti ti-arrow-right fs-6"></i>
                          </div>
                        </div>
                    </router-link>
                </div>
              </div>

              <!-- <div class="col-lg-3">
                <div class="card">
                      <div class="card-body">
                        <div class="row alig n-items-start">
                          <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Admins </h5>
                            <h4 class="fw-semibold mb-3">{{ totalAdminCount }}</h4>
                            <div class="d-flex align-items-center pb-1">
                              <span
                                class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-calendar text-danger"></i>
                              </span>
                             <select name="date_range" @change="getAdminCount()" v-model="selectedAdminStatus" class="form-control">
                                <option selected value="total" >Total</option>
                                <option value="today" >Hoje</option>
                                <option value="30" >30 dias</option>
                                <option value="60" >60 dias</option>
                                <option value="360" >360 dias</option>
                                <option value="monthtodate" >Inicio Mês até Hoje</option>
                                <option value="yeartodate" >Inicio Ano até Hoje</option>
                             </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="d-flex justify-content-end">
                              <div
                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="ti ti-users fs-6"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                </div>
              </div>


              <div class="col-lg-3">
                <div class="card">
                      <div class="card-body">
                        <div class="row alig n-items-start">
                          <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Usuários </h5>
                            <h4 class="fw-semibold mb-3">{{ totalUserCount }}</h4>
                            <div class="d-flex align-items-center pb-1">
                              <span
                                class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-calendar text-danger"></i>
                              </span>
                              <select name="date_range" @change="getUserCount()" v-model="selectedUserStatus" class="form-control">
                                <option selected value="total" >Total</option>
                                <option value="today" >Hoje</option>
                                <option value="30" >30 dias</option>
                                <option value="60" >60 dias</option>
                                <option value="360" >360 dias</option>
                                <option value="monthtodate" >Inicio Mês até Hoje</option>
                                <option value="yeartodate" >Inicio Ano até Hoje</option>
                             </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="d-flex justify-content-end">
                              <div
                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="ti ti-users fs-6"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                </div>
              </div> -->


            </div>
            <div class="row">
            <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Quota dos Associados</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">#</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Ref Quota</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Empresa</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Valor</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Estado</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(quote,index) in quotes" :key="quote.id">
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">#{{ index+1 }}</h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">{{ quote.ref }}</h6>                         
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ quote.company.company_name }}</p>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ quote.amount }} MT</p>
                        </td>
                        <td class="border-bottom-0">
                          <span class="badge bg-danger rounded-3 fw-semibold" v-if="quote.status==0">Não Pago</span> <span class="badge bg-success rounded-3 fw-semibold" v-else>Pago</span>
                        </td>
                      </tr> 
                                        
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-4">
                <div class="card">
                      <div class="card-body">
                        <div class="row alig n-items-start">
                          <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Quotas </h5>
                            <h4 class="fw-semibold mb-3">{{ totalQuoteCount }}</h4>
                            <h5 class="card-title mb-9 fw-semibold"> Valor </h5>
                            <h4 class="fw-semibold mb-3">{{ totalQuoteAmount }} MT</h4>
                            <div class="d-flex align-items-center pb-1">
                              <span
                                class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-calendar text-danger"></i>
                              </span>
                              <select name="date_range" @change="getQuoteCount()" v-model="selectedQuoteStatus" class="form-control">
                                <option selected value="total" >Total</option>
                                <option value="today" >Hoje</option>
                                <option value="30" >30 dias</option>
                                <option value="60" >60 dias</option>
                                <option value="360" >360 dias</option>
                                <option value="monthtodate" >Inicio Mês até Hoje</option>
                                <option value="yeartodate" >Inicio Ano até Hoje</option>
                             </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="d-flex justify-content-end">
                              <div
                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="ti ti-currency-dollar fs-6"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <router-link class="sidebar-link" to="/manager/quotes" aria-expanded="false">
                        <div class="card-footer">
                          <div class="d-flex justify-content-between">
                            <span>Ver Quotas</span>
                            <i class="ti ti-arrow-right fs-6"></i>
                          </div>
                        </div>
                    </router-link>
                </div>
              </div> -->
        </div>

        <!-- <div class="row">
            <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
              <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">Despesas Recentes</h5>
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                      <tr>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">#</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Despesa</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Valor</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Criado por</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Data</h6>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(expense,index) in expenses" :key="expense.id">
                        <td class="border-bottom-0"><h6 class="fw-semibold mb-0">#{{ index+1 }}</h6></td>
                        <td class="border-bottom-0">
                            <h6 class="fw-semibold mb-1">{{ expense.name }}</h6>                         
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ expense.amount }} MT</p>
                        </td>
                        <td class="border-bottom-0">
                          <p class="mb-0 fw-normal">{{ expense.user.name }} MT</p>
                        </td>
                        <td class="border-bottom-0">
                          <h6 class="fw-semibold mb-0 fs-4">{{ expense.date }}</h6>
                        </td>
                      </tr> 
                                        
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
                <div class="card">
                      <div class="card-body">
                        <div class="row alig n-items-start">
                          <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold"> Despesas </h5>
                            <h4 class="fw-semibold mb-3">{{ totalExpenseCount }}</h4>
                            <h5 class="card-title mb-9 fw-semibold"> Valor </h5>
                            <h4 class="fw-semibold mb-3">{{ totalExpenseAmount }} MT</h4>
                            <div class="d-flex align-items-center pb-1">
                              <span
                                class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                <i class="ti ti-calendar text-danger"></i>
                              </span>
                              <select name="date_range" @change="getExpenseCount()" v-model="selectedExpenseStatus" class="form-control">
                                <option selected value="total" >Total</option>
                                <option value="today" >Hoje</option>
                                <option value="30" >30 dias</option>
                                <option value="60" >60 dias</option>
                                <option value="360" >360 dias</option>
                                <option value="monthtodate" >Inicio Mês até Hoje</option>
                                <option value="yeartodate" >Inicio Ano até Hoje</option>
                             </select>
                            </div>
                          </div>
                          <div class="col-4">
                            <div class="d-flex justify-content-end">
                              <div
                                class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                <i class="ti ti-currency-dollar fs-6"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <router-link class="sidebar-link" to="/manager/expenses" aria-expanded="false">
                        <div class="card-footer">
                          <div class="d-flex justify-content-between">
                            <span>Ver Despesas</span>
                            <i class="ti ti-arrow-right fs-6"></i>
                          </div>
                        </div>
                    </router-link>
                </div>
              </div>
        </div> -->
        <div class="row">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4">Eventos</h5>
              
            
              <FullCalendar :options="calendarOptions"/>

            </div>
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


