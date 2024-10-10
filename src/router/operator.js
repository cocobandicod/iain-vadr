import OperatorDashboard from '../views/operator/dashboard.vue';
// Monitoring
import OperatorMasterDosen from '../views/operator/dosen.vue';
import OperatorMasterMahasiswa from '../views/operator/mahasiswa.vue';
import OperatorMasterPegawai from '../views/operator/pegawai.vue';
import OperatorMasterLainnya from '../views/operator/lainnya.vue';

import OperatorMahasiswaPesan from '../views/operator/mahasiswa_pesan.vue';
import OperatorMahasiswaGroup from '../views/operator/mahasiswa_group.vue';
import OperatorMahasiswaDetailGroup from '../views/operator/mahasiswa_detail_group.vue';

import OperatorOrangtuaPesan from '../views/operator/orangtua_pesan.vue';
import OperatorOrangtuaGroup from '../views/operator/orangtua_group.vue';
import OperatorOrangtuaDetailGroup from '../views/operator/orangtua_detail_group.vue';

import OperatorDosenPesan from '../views/operator/dosen_pesan.vue';
import OperatorDosenGroup from '../views/operator/dosen_group.vue';
import OperatorDosenDetailGroup from '../views/operator/dosen_detail_group.vue';

import OperatorPegawaiPesan from '../views/operator/Pegawai_pesan.vue';
import OperatorPegawaiGroup from '../views/operator/pegawai_group.vue';
import OperatorPegawaiDetailGroup from '../views/operator/pegawai_detail_group.vue';

import OperatorLainnyaPesan from '../views/operator/lainnya_pesan.vue';
import OperatorLainnyaGroup from '../views/operator/lainnya_group.vue';
import OperatorLainnyaDetailGroup from '../views/operator/lainnya_detail_group.vue';
import OperatorReportPesan from '../views/operator/report_pesan.vue';

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
      path: '/operator/pesan/mahasiswa',
      name: 'OperatorMahasiswaPesan',
      component: OperatorMahasiswaPesan,
      meta: { 
          title: 'Operator Pesan Mahasiswa | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/mahasiswa',
      name: 'OperatorMahasiswaGroup',
      component: OperatorMahasiswaGroup,
      meta: { 
          title: 'Operator Pesan Group Mahasiswa | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/mahasiswa/:kode',
      name: 'OperatorMahasiswaDetailGroup',
      component: OperatorMahasiswaDetailGroup,
      meta: { 
          title: 'Operator Pesan Group Mahasiswa | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/orangtua',
      name: 'OperatorOrangtuaPesan',
      component: OperatorOrangtuaPesan,
      meta: { 
          title: 'Operator Pesan Orang Tua | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/orangtua',
      name: 'OperatorOrangtuaGroup',
      component: OperatorOrangtuaGroup,
      meta: { 
          title: 'Operator Pesan Group Orang Tua | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/orangtua/:kode',
      name: 'OperatorOrangtuaDetailGroup',
      component: OperatorOrangtuaDetailGroup,
      meta: { 
          title: 'Operator Pesan Group Orang Tua | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/dosen',
      name: 'OperatorDosenPesan',
      component: OperatorDosenPesan,
      meta: { 
          title: 'Operator Pesan Dosen | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/dosen',
      name: 'OperatorDosenGroup',
      component: OperatorDosenGroup,
      meta: { 
          title: 'Operator Pesan Group Dosen | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/dosen/:kode',
      name: 'OperatorDosenDetailGroup',
      component: OperatorDosenDetailGroup,
      meta: { 
          title: 'Operator Pesan Group Dosen | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/pegawai',
      name: 'OperatorPegawaiPesan',
      component: OperatorPegawaiPesan,
      meta: { 
          title: 'Operator Pesan Dosen | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/pegawai',
      name: 'OperatorPegawaiGroup',
      component: OperatorPegawaiGroup,
      meta: { 
          title: 'Operator Pesan Group Pegawai | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/pegawai/:kode',
      name: 'OperatorPegawaiDetailGroup',
      component: OperatorPegawaiDetailGroup,
      meta: { 
          title: 'Operator Pesan Group Pegawai | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/lainnya',
      name: 'OperatorLainnyaPesan',
      component: OperatorLainnyaPesan,
      meta: { 
          title: 'Operator Pesan Lainnya | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/lainnya',
      name: 'OperatorLainnyaGroup',
      component: OperatorLainnyaGroup,
      meta: { 
          title: 'Operator Pesan Group Lainnya | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/pesan/group/lainnya/:kode',
      name: 'OperatorLainnyaDetailGroup',
      component: OperatorLainnyaDetailGroup,
      meta: { 
          title: 'Operator Pesan Group Lainnya | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
    {
      path: '/operator/report/pesan',
      name: 'OperatorReportPesan',
      component: OperatorReportPesan,
      meta: { 
          title: 'Operator Report Pesan Lainnya | VADR IAIN Sultan Amai Gorontalo', 
          requiresAuth: true, // Memerlukan autentikasi
          allowedRoles: ['Operator']
      }
    },
  ];