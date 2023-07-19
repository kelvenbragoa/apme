import './bootstrap';
import { createApp } from 'vue';
import { createRouter, createWebHistory } from 'vue-router';
import Routes from './routes';
import Login from './pages/auth/Login.vue';
import Register from './pages/auth/Register.vue';
// import FullCalendar from './pages/admin/calendars/calendar.vue';



const app = createApp({});
const router = createRouter({
    routes:Routes,
    history:createWebHistory(),
});



app.component('Login',Login);
app.component('Register',Register);
// app.component('FullCalendar',FullCalendar);
app.use(router);
app.mount('#app');