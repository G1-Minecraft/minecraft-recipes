import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RegisterView from "@/views/RegisterView.vue";
import ConnexionView from "@/views/ConnexionView.vue";
import ItemCreationComponent from "@/components/layout/ItemCreationComponent.vue";
import CraftCreationComponent from "@/components/layout/CraftCreationComponent.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView
    },
    {
      path: '/connexion',
      name: 'connexion',
      component: ConnexionView
    },
    {
      path: '/items',
      name: 'items',
      component: ItemCreationComponent
    },
    {
      path: '/crafts',
      name: 'crafts',
      component: CraftCreationComponent
    }
  ]
})

export default router
