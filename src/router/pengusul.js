// Pengusul Page
import PengusulDashboard from '../views/pengusul/dashboard.vue';
import RiwayatPenelitian from '../views/pengusul/riwayat_penelitian.vue';
import RiwayatPengabdian from '../views/pengusul/riwayat_pengabdian.vue';
// Penelitian
import PenelitianUsulanBaru from '../views/pengusul/penelitian_usulan_baru.vue';
import PenelitianStatusUsulanDetail from '../views/pengusul/penelitian_usulan_baru_detail.vue';

import PenelitianPerbaikanUsulan from '../views/pengusul/penelitian_perbaikan_usulan.vue';
import PenelitianPerbaikanUsulanDetail from '../views/pengusul/penelitian_perbaikan_usulan_detail.vue';
import PenelitianLaporanKemajuan from '../views/pengusul/penelitian_laporan_kemajuan.vue';
import PenelitianLaporanKemajuanDetail from '../views/pengusul/penelitian_laporan_kemajuan_detail.vue';
import PenelitianLaporanAkhir from '../views/pengusul/penelitian_laporan_akhir.vue';
import PenelitianLaporanAkhirDetail from '../views/pengusul/penelitian_laporan_akhir_detail.vue';
import PenelitianCatatanHarian from '../views/pengusul/penelitian_catatan_harian.vue';


// Pengabdian
import PengabdianUsulanBaru from '../views/pengusul/pengabdian_usulan_baru.vue';
import PengabdianPerbaikanUsulan from '../views/pengusul/pengabdian_perbaikan_usulan.vue';
import PengabdianLaporanKemajuan from '../views/pengusul/pengabdian_laporan_kemajuan.vue';
import PengabdianLaporanAkhir from '../views/pengusul/pengabdian_laporan_akhir.vue';
import PengabdianCatatanHarian from '../views/pengusul/pengabdian_catatan_harian.vue';

//Form
import FormIdentitas from '../views/pengusul/form/form_identitas.vue';
import FormSinta from '../views/pengusul/form/form_sinta.vue';


import PengusulInsentif from '../views/pengusul/insentif.vue';
import PengusulDownload from '../views/pengusul/download.vue';

export default [
  // ----------------------------------------------------------------------------------- Pengusul Page
  {
    path: '/pengusul/dashboard',
    name: 'PengusulDashboard',
    component: PengusulDashboard,
    meta: { 
        title: 'Pengusul | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/riwayat-penelitian',
    name: 'RiwayatPenelitian',
    component: RiwayatPenelitian,
    meta: { 
        title: 'Riwayat Penelitian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/riwayat-pengabdian',
    name: 'RiwayatPengabdian',
    component: RiwayatPengabdian,
    meta: { 
        title: 'Riwayat Pengabdian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  // ----------------------------------------------------------------------------------------------- PENELITIAN
  {
    path: '/pengusul/penelitian/usulan-baru',
    name: 'PenelitianUsulanBaru',
    component: PenelitianUsulanBaru,
    meta: { 
        title: 'Usulan Baru Penelitian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/penelitian/usulan-baru/detail',
    name: 'PenelitianStatusUsulanDetail',
    component: PenelitianStatusUsulanDetail,
    meta: { 
        title: 'Detail Usulan Baru Penelitian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/penelitian/perbaikan-usulan',
    name: 'PenelitianPerbaikanUsulan',
    component: PenelitianPerbaikanUsulan,
    meta: { 
        title: 'Perbaikan Usulan Penelitian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/penelitian/perbaikan-usulan/detail',
    name: 'PenelitianPerbaikanUsulanDetail',
    component: PenelitianPerbaikanUsulanDetail,
    meta: { 
        title: 'Perbaikan Usulan Penelitian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/penelitian/laporan-kemajuan',
    name: 'PenelitianLaporanKemajuan',
    component: PenelitianLaporanKemajuan,
    meta: { 
        title: 'Laporan Kemajuan Penelitian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/penelitian/laporan-kemajuan/detail',
    name: 'PenelitianLaporanKemajuanDetail',
    component: PenelitianLaporanKemajuanDetail,
    meta: { 
        title: 'Laporan Kemajuan Detail Penelitian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/penelitian/laporan-akhir',
    name: 'PenelitianLaporanAkhir',
    component: PenelitianLaporanAkhir,
    meta: { 
        title: 'Laporan Akhir Penelitian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/penelitian/laporan-akhir/detail',
    name: 'PenelitianLaporanAkhirDetail',
    component: PenelitianLaporanAkhirDetail,
    meta: { 
        title: 'Laporan Akhir Detail Penelitian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/penelitian/catatan-harian',
    name: 'PenelitianCatatanHarian',
    component: PenelitianCatatanHarian,
    meta: { 
        title: 'Catatan Harian Penelitian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  // ----------------------------------------------------------------------------------------------- PENGABDIAN
  {
    path: '/pengusul/pengabdian/usulan-baru',
    name: 'PengabdianUsulanBaru',
    component: PengabdianUsulanBaru,
    meta: { 
        title: 'Usulan Baru Pengabdian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/pengabdian/perbaikan-usulan',
    name: 'PengabdianPerbaikanUsulan',
    component: PengabdianPerbaikanUsulan,
    meta: { 
        title: 'Perbaikan Usulan Pengabdian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/pengabdian/laporan-kemajuan',
    name: 'PengabdianLaporanKemajuan',
    component: PengabdianLaporanKemajuan,
    meta: { 
        title: 'Laporan Kemajuan Pengabdian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/pengabdian/laporan-akhir',
    name: 'PengabdianLaporanAkhir',
    component: PengabdianLaporanAkhir,
    meta: { 
        title: 'Laporan Akhir Pengabdian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/pengabdian/catatan-harian',
    name: 'PengabdianCatatanHarian',
    component: PengabdianCatatanHarian,
    meta: { 
        title: 'Catatan Harian Pengabdian | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/form-identitas',
    name: 'FormIdentitas',
    component: FormIdentitas,
    meta: { 
        title: 'Form Identitas | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/form-sinta',
    name: 'FormSinta',
    component: FormSinta,
    meta: { 
        title: 'Form Sinta | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/insentif',
    name: 'PengusulInsentif',
    component: PengusulInsentif,
    meta: { 
        title: 'Insentif | Paluwala LPPM Universitas Negeri Gorontalo', 
        requiresAuth: true // Memerlukan autentikasi
    }
  },
  {
    path: '/pengusul/download',
    name: 'PengusulDownload',
    component: PengusulDownload,
    meta: { 
        title: 'Download | Paluwala LPPM Universitas Negeri Gorontalo',
        requiresAuth: true // Memerlukan autentikasi
    }
  },
];
