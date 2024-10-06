// Dosen Page
import PegawaiDashboard from '../views/pegawai/dashboard.vue';

export default [
  // ----------------------------------------------------------------------------------- Pegawai Page
  {
    path: '/pegawai/dashboard',
    name: 'PegawaiDashboard',
    component: PegawaiDashboard,
    meta: { 
        title: 'Dashboard | VADR IAIN Sultan Amai Gorontalo', 
        requiresAuth: true, // Memerlukan autentikasi
        allowedRoles: ['Pegawai']
    }
  },
];
