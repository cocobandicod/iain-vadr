import Home from '../views/home.vue';
import Login from '../components/login.vue';
import Logout from '../components/operator_header.vue';

export default [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: { title: 'Home | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: { title: 'Login | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/logout',
    name: 'Logout',
    component: Logout,
    meta: { title: 'Logout | VADR IAIN Sultan Amai Gorontalo' }
  },
];
