


<script setup>
import axios from 'axios';
import { ref, onMounted, reactive, defineEmits, defineComponent } from "vue";
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'


const loadingDiv = ref(true);

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

const getEventList = async () => {
  axios.get('/manager-calendars')
       .then((response)=>{
        calendarOptions.events = response.data;
        loadingDiv.value=false;
       })
}

onMounted(()=>{
     getEventList();
})

</script>


<template>
<!-- <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Calendário</h5>
            <p class="mb-0">Eventos</p>
          
            <FullCalendar :options="calendarOptions"/>

          </div>
    </div> -->


<div v-if="!loadingDiv">
    <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Calendário</h5>
            <p class="mb-0">Eventos</p>
          
            <FullCalendar :options="calendarOptions"/>

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