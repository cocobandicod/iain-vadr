import { createRouter, createWebHistory } from 'vue-router';
import homeRoutes from './home';
import pengusulRoutes from './pengusul';
import operatorRoutes from './operator';
import NotFound from '../components/NotFound.vue';

const routes = [
  ...homeRoutes,
  ...pengusulRoutes,
  ...operatorRoutes,
  {
    path: '/:pathMatch(.*)*', // Catch-all untuk rute yang tidak cocok
    name: 'NotFound',
    component: NotFound,
    meta: {
      title: '404 - Halaman Tidak Ditemukan',
    },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.requiresAuth)) {
    const token = localStorage.getItem('token');
    if (!token) {
      next({ path: '/login' });
    } else {
      next();
    }
  } else {
    next();
  }
  if (to.meta && to.meta.title) {
    document.title = to.meta.title;
  } else {
    // Title default jika meta title tidak tersedia
    document.title = 'Default Title';
  }
});

export default router;
