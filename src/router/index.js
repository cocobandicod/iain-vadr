import { createRouter, createWebHistory } from 'vue-router';
import homeRoutes from './home';
import mahasiswaRoutes from './mahasiswa';
import dosenRoutes from './dosen';
import pegawaiRoutes from './pegawai';
import operatorRoutes from './operator';
import NotFound from '../components/NotFound.vue';

const routes = [
  ...homeRoutes,
  ...mahasiswaRoutes,
  ...dosenRoutes,
  ...pegawaiRoutes,
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
  const token = localStorage.getItem('token');
  const hakAkses = localStorage.getItem('hak_akses'); // Ambil hak akses dari localStorage
  
  if (to.matched.some(record => record.meta.requiresAuth)) {
    // Cek apakah pengguna sudah login (memiliki token)
    if (!token) {
      next({ path: '/login' });
      return;  // Pastikan menggunakan return setelah next() di dalam fungsi
    }

    // Cek apakah pengguna berhak mengakses halaman berdasarkan hak akses
    const allowedRoles = to.meta.allowedRoles;
    if (allowedRoles && !allowedRoles.includes(hakAkses)) {
      //alert('Anda tidak berhak mengakses halaman ini!');
      next({ path: '/404' }); // Redirect ke halaman akses ditolak
      return;  // Pastikan menggunakan return setelah next() di dalam fungsi
    }
  }

  // Set judul halaman jika tersedia di meta
  if (to.meta && to.meta.title) {
    document.title = to.meta.title;
  } else {
    document.title = 'Default Title'; // Default title jika meta title tidak tersedia
  }

  next(); // Lanjutkan navigasi jika semua pengecekan lolos
});

export default router;
