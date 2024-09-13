import { createRouter, createWebHistory } from 'vue-router';
import Home from '@/pages/Home.vue';
import Todo from '@/pages/Todo.vue';

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/todo',
    name: 'Todo',
    component: Todo
  },
  // You can add more routes here
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
});

export default router;
