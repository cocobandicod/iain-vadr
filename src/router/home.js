import Home from '../views/home.vue';
import Panduan from '../views/panduan.vue';
import Berita from '../views/berita.vue';
import Pengumuman from '../views/pengumuman.vue';
import LowonganPenelitian from '../views/lowongan_penelitian.vue';
import LowonganPengabdian from '../views/lowongan_pengabdian.vue';
import BeritaDetail from '../views/berita_detail.vue';
import Login from '../components/login.vue';
import Register from '../components/register.vue';
import Logout from '../components/operator_header.vue';

export default [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: { title: 'Home | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/panduan',
    name: 'panduan',
    component: Panduan,
    meta: { title: 'Panduan | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/pengumuman',
    name: 'pengumuman',
    component: Pengumuman,
    meta: { title: 'Pengumuman | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/lowongan-penelitian',
    name: 'LowonganPenelitian',
    component: LowonganPenelitian,
    meta: { title: 'Lowongan Penelitian | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/lowongan-pengabdian',
    name: 'LowonganPengabdian',
    component: LowonganPengabdian,
    meta: { title: 'Lowongan Pengabdian | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/berita',
    name: 'berita',
    component: Berita,
    meta: { title: 'Berita | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/berita/:slug',
    name: 'BeritaDetail',
    component: BeritaDetail,
    meta: { title: 'Berita | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/login',
    name: 'Login',
    component: Login,
    meta: { title: 'Login | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/register',
    name: 'Register',
    component: Register,
    meta: { title: 'Register | VADR IAIN Sultan Amai Gorontalo' }
  },
  {
    path: '/logout',
    name: 'Logout',
    component: Logout,
    meta: { title: 'Logout | VADR IAIN Sultan Amai Gorontalo' }
  },
];
