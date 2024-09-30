import OperatorDashboard from '../views/operator/dashboard.vue';
// Monitoring
import OperatorPerbaikanUsulan from '../views/operator/perbaikan_usulan.vue';
import OperatorPerbaikanUsulanDetail from '../views/operator/perbaikan_usulan_detail.vue';
import OperatorCatatanHarian from '../views/operator/catatan_harian.vue';

import OperatorLaporanKemajuan from '../views/operator/perbaikan_usulan.vue';
import OperatorLaporanAkhir from '../views/operator/perbaikan_usulan.vue';
import OperatorMonevInternal from '../views/operator/perbaikan_usulan.vue';
import OperatorProfilLembaga from '../views/operator/profil_lembaga.vue';
import OperatorRab from '../views/operator/kelompok_rab.vue';
import OperatorRabEdit from '../views/operator/form/form_kelompok_rab_edit.vue';
import OperatorRabAdd from '../views/operator/form/form_kelompok_rab_add.vue';
import OperatorBerita from '../views/operator/berita.vue';
import OperatorBeritaEdit from '../views/operator/form/form_berita_edit.vue';
import OperatorBeritaAdd from '../views/operator/form/form_berita_add.vue';
import OperatorPengumuman from '../views/operator/pengumuman.vue';
import OperatorPengumumanAdd from '../views/operator/form/form_pengumuman_add.vue';
import OperatorPengumumanEdit from '../views/operator/form/form_pengumuman_edit.vue';
import OperatorPanduan from '../views/operator/panduan.vue';
import OperatorPanduanAdd from '../views/operator/form/form_panduan_add.vue';
import OperatorPanduanEdit from '../views/operator/form/form_panduan_edit.vue';
import OperatorTautan from '../views/operator/tautan.vue';
import OperatorTautanAdd from '../views/operator/form/form_tautan_add.vue';
import OperatorTautanEdit from '../views/operator/form/form_tautan_edit.vue';
import OperatorSponsor from '../views/operator/sponsor.vue';
import OperatorSponsorEdit from '../views/operator/form/form_sponsor_edit.vue';
import OperatorSponsorAdd from '../views/operator/form/form_sponsor_add.vue';

import OperatorBorangPenilaian from '../views/operator/perbaikan_usulan.vue';
import OperatorDaftarReviewer from '../views/operator/perbaikan_usulan.vue';
import OperatorPenugasanReview from '../views/operator/perbaikan_usulan.vue';
import OperatorPlotingReviewer from '../views/operator/perbaikan_usulan.vue';
import OperatorReviewerExternal from '../views/operator/perbaikan_usulan.vue';
import OperatorMonitoringPenilaian from '../views/operator/perbaikan_usulan.vue';

export default [
    // ----------------------------------------------------------------------------------- Operator Page
    {
      path: '/operator/dashboard',
      name: 'OperatorDashboard',
      component: OperatorDashboard,
      meta: { 
          title: 'Operator | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/monitoring/perbaikan-usulan',
      name: 'OperatorPerbaikanUsulan',
      component: OperatorPerbaikanUsulan,
      meta: { 
          title: 'Operator Perbaikan Usulan | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/monitoring/perbaikan-usulan/detail',
      name: 'OperatorPerbaikanUsulanDetail',
      component: OperatorPerbaikanUsulanDetail,
      meta: { 
          title: 'Operator Perbaikan Usulan Detail | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/monitoring/catatan-harian',
      name: 'OperatorCatatanHarian',
      component: OperatorCatatanHarian,
      meta: { 
          title: 'Operator Catatan Harian | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/monitoring/laporan-kemajuan',
      name: 'OperatorLaporanKemajuan',
      component: OperatorLaporanKemajuan,
      meta: { 
          title: 'Operator Laporan Kemajuan | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/monitoring/laporan-akhir',
      name: 'OperatorLaporanAkhir',
      component: OperatorLaporanAkhir,
      meta: { 
          title: 'Operator Laporan Akhir | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/monitoring/monev-internal',
      name: 'OperatorMonevInternal',
      component: OperatorMonevInternal,
      meta: { 
          title: 'Operator Monev Internal | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    // ----------------------------------------------------------------------------------- Pendukung Page
    {
      path: '/operator/pendukung/profil-lembaga',
      name: 'OperatorProfilLembaga',
      component: OperatorProfilLembaga,
      meta: { 
          title: 'Operator Profil Lembaga | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/rab',
      name: 'OperatorRab',
      component: OperatorRab,
      meta: { 
          title: 'Operator Kelompok RAB | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/rab/edit/:id',
      name: 'OperatorRabEdit',
      component: OperatorRabEdit,
      meta: { 
          title: 'Operator Edit Kelompok RAB | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/rab/add',
      name: 'OperatorRabAdd',
      component: OperatorRabAdd,
      meta: { 
          title: 'Operator Tambah Kelompok RAB | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/berita',
      name: 'OperatorBerita',
      component: OperatorBerita,
      meta: { 
          title: 'Operator Berita | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/berita/add',
      name: 'OperatorBeritaAdd',
      component: OperatorBeritaAdd,
      meta: { 
          title: 'Operator Tambah Berita | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/berita/edit/:id',
      name: 'OperatorBeritaEdit',
      component: OperatorBeritaEdit,
      meta: { 
          title: 'Operator Edit Berita | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/pengumuman',
      name: 'OperatorPengumuman',
      component: OperatorPengumuman,
      meta: { 
          title: 'Operator Pengumuman | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/pengumuman/add',
      name: 'OperatorPengumumanAdd',
      component: OperatorPengumumanAdd,
      meta: { 
          title: 'Operator Tambah Pengumuman | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/pengumuman/edit/:id',
      name: 'OperatorPengumumanEdit',
      component: OperatorPengumumanEdit,
      meta: { 
          title: 'Operator Edit Pengumuman | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/panduan',
      name: 'OperatorPanduan',
      component: OperatorPanduan,
      meta: { 
          title: 'Operator Panduan | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/panduan/add',
      name: 'OperatorPanduanAdd',
      component: OperatorPanduanAdd,
      meta: { 
          title: 'Operator Tambah Panduan | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/panduan/edit/:id',
      name: 'OperatorPanduanEdit',
      component: OperatorPanduanEdit,
      meta: { 
          title: 'Operator Edit Panduan | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/tautan',
      name: 'OperatorTautan',
      component: OperatorTautan,
      meta: { 
          title: 'Operator Tautan | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/tautan/add',
      name: 'OperatorTautanAdd',
      component: OperatorTautanAdd,
      meta: { 
          title: 'Operator Tambah Tautan | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/tautan/edit/:id',
      name: 'OperatorTautanEdit',
      component: OperatorTautanEdit,
      meta: { 
          title: 'Operator Edit Tautan | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/sponsor',
      name: 'OperatorSponsor',
      component: OperatorSponsor,
      meta: { 
          title: 'Operator Sponsor | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/sponsor/add',
      name: 'OperatorSponsorAdd',
      component: OperatorSponsorAdd,
      meta: { 
          title: 'Operator Tambah Sponsor | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/pendukung/sponsor/edit/:id',
      name: 'OperatorSponsorEdit',
      component: OperatorSponsorEdit,
      meta: { 
          title: 'Operator Edit Sponsor | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    // ----------------------------------------------------------------------------------- Reviewer Page
    {
      path: '/operator/reviewer/borang-penilaian',
      name: 'OperatorBorangPenilaian',
      component: OperatorBorangPenilaian,
      meta: { 
          title: 'Operator Borang Penilaian | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/reviewer/daftar-reviewer',
      name: 'OperatorDaftarReviewer',
      component: OperatorDaftarReviewer,
      meta: { 
          title: 'Operator Daftar Reviewer | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/reviewer/reviewer-external',
      name: 'OperatorReviewerExternal',
      component: OperatorReviewerExternal,
      meta: { 
          title: 'Operator Reviewer External | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/reviewer/penugasan-reviewer',
      name: 'OperatorPenugasanReview',
      component: OperatorPenugasanReview,
      meta: { 
          title: 'Operator Penugasan Reviewer | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/reviewer/ploting-reviewer',
      name: 'OperatorPlotingReviewer',
      component: OperatorPlotingReviewer,
      meta: { 
          title: 'Operator Ploting Reviewer | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
    {
      path: '/operator/reviewer/monitoring-penilaian',
      name: 'OperatorMonitoringPenilaian',
      component: OperatorMonitoringPenilaian,
      meta: { 
          title: 'Operator Monitoring Penilaian | Paluwala LPPM Universitas Negeri Gorontalo', 
          requiresAuth: true // Memerlukan autentikasi
      }
    },
  ];