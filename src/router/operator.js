import OperatorDashboard from '../views/operator/dashboard.vue';
// Monitoring
import OperatorMasterDosen from '../views/operator/dosen.vue';
import OperatorMasterMahasiswa from '../views/operator/mahasiswa.vue';
import OperatorMasterPegawai from '../views/operator/pegawai.vue';
import OperatorMasterLainnya from '../views/operator/lainnya.vue';
import OperatorPesanGroupLainnya from '../views/operator/pesan_group_lainnya.vue';

export default [
    // ----------------------------------------------------------------------------------- Operator Page
    {
      path: '/operator/dashboard',
      name: 'OperatorDashboard',
      component: OperatorDashboard,
      meta: { 
          title: 'Operator | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/master/dosen',
      name: 'OperatorMasterDosen',
      component: OperatorMasterDosen,
      meta: { 
          title: 'Operator Master Dosen | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/master/mahasiswa',
      name: 'OperatorMasterMahasiswa',
      component: OperatorMasterMahasiswa,
      meta: { 
          title: 'Operator Master Mahasiswa | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/master/pegawai',
      name: 'OperatorMasterPegawai',
      component: OperatorMasterPegawai,
      meta: { 
          title: 'Operator Master Pegawai | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/master/lainnya',
      name: 'OperatorMasterLainnya',
      component: OperatorMasterLainnya,
      meta: { 
          title: 'Operator Pesan Group Lainnya | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/lainnya',
      name: 'OperatorPesanGroupLainnya',
      component: OperatorPesanGroupLainnya,
      meta: { 
          title: 'Operator Pesan Group Lainnya | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
  ];