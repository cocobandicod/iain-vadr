// Dosen Page
import DosenDashboard from '../views/dosen/dashboard.vue';
import DosenDashboardPengaduan from '../views/dosen/pengaduan.vue';
import DosenDashboardPengaduanLaporan from '../views/dosen/pengaduan_laporan.vue';

export default [
  // ----------------------------------------------------------------------------------- Mahasiswa Page
  {
    path: '/dosen/dashboard',
    name: 'DosenDashboard',
    component: DosenDashboard,
    meta: { 
        title: 'Dashboard | VADR IAIN Sultan Amai Gorontalo', 
        requiresAuth: true, // Memerlukan autentikasi
        allowedRoles: ['Dosen']
    }
  },
  {
    path: '/dosen/pengaduan',
    name: 'DosenDashboardPengaduan',
    component: DosenDashboardPengaduan,
    meta: { 
        title: 'Pengaduan | VADR IAIN Sultan Amai Gorontalo', 
        requiresAuth: true, // Memerlukan autentikasi
        allowedRoles: ['Dosen']
    }
  },
  {
    path: '/dosen/pengaduan/laporan',
    name: 'DosenDashboardPengaduanLaporan',
    component: DosenDashboardPengaduanLaporan,
    meta: { 
        title: 'Pengaduan | VADR IAIN Sultan Amai Gorontalo', 
        requiresAuth: true, // Memerlukan autentikasi
        allowedRoles: ['Dosen']
    }
  },
];
