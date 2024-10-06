// Mahasiswa Page
import MahasiswaDashboard from '../views/mahasiswa/dashboard.vue';
import MahasiswaDashboardPengaduan from '../views/mahasiswa/pengaduan.vue';

export default [
  // ----------------------------------------------------------------------------------- Mahasiswa Page
  {
    path: '/mahasiswa/dashboard',
    name: 'MahasiswaDashboard',
    component: MahasiswaDashboard,
    meta: { 
        title: 'Dashboard | VADR IAIN Sultan Amai Gorontalo', 
        requiresAuth: true, // Memerlukan autentikasi
        allowedRoles: ['Mahasiswa']
    }
  },
  {
    path: '/mahasiswa/pengaduan',
    name: 'MahasiswaDashboardPengaduan',
    component: MahasiswaDashboardPengaduan,
    meta: { 
        title: 'Pengaduan | VADR IAIN Sultan Amai Gorontalo', 
        requiresAuth: true, // Memerlukan autentikasi
        allowedRoles: ['Mahasiswa']
    }
  },
];
