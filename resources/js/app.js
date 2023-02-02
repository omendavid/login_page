import { createApp } from 'vue';
import Index from './components/Index.vue';
import Router from './router'


import './bootstrap';

  
const app = createApp(Index)

app.use(Router)
app.mount('#app')