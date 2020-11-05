import { createRouter, createWebHistory } from 'vue-router'
import HomeComponent from '../components/HelloWorld.vue'
import ContactComponent from '../components/ContactComponent.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
      {
        path: '/',
        component: HomeComponent
      },
      {
        path: '/contact',
        component: ContactComponent
      }
    ]
  })

export default router