<script setup>
import GlobalHeader from "../components/operator_header.vue";
</script>
<template>
    <GlobalHeader />
    <div>
        <div class="app-menu navbar-menu">
            <!-- LOGO -->

            <div id="scrollbar">
                <div class="container-fluid">
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title">
                            <span data-key="t-menu">Menu</span>
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link menu-link collapsed"
                                href="#sidebarDashboards"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarDashboards"
                            >
                                <i class="ri-home-smile-line"></i>
                                <span data-key="t-dashboards">Dashboards</span>
                            </a>
                            <div
                                class="menu-dropdown collapse"
                                id="sidebarDashboards"
                                style=""
                            >
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorDashboard',
                                            }"
                                            class="nav-link"
                                        >
                                            Operator
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'PengusulDashboard',
                                            }"
                                            class="nav-link"
                                        >
                                            Pengusul
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- end Dashboard Menu -->
                        <li class="nav-item">
                            <a
                                class="nav-link menu-link collapsed"
                                href="#sidebarApps"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarApps"
                            >
                                <i class="ri-rocket-line"></i>
                                <span data-key="t-apps">Monitoring</span>
                            </a>
                            <div
                                class="menu-dropdown collapse"
                                id="sidebarApps"
                                style=""
                            >
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorPerbaikanUsulan',
                                            }"
                                            class="nav-link"
                                        >
                                            Perbaikan Usulan
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorCatatanHarian',
                                            }"
                                            class="nav-link"
                                        >
                                            Catatan Harian
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorLaporanKemajuan',
                                            }"
                                            class="nav-link"
                                        >
                                            Laporan Kemajuan
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorLaporanAkhir',
                                            }"
                                            class="nav-link"
                                        >
                                            Laporan Akhir
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorMonevInternal',
                                            }"
                                            class="nav-link"
                                        >
                                            Monev Internal PT
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link menu-link collapsed"
                                href="#sidebarLayouts"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarLayouts"
                            >
                                <i class="ri-server-line"></i>
                                <span data-key="t-layouts">Data Pendukung</span>
                                <span
                                    class="badge badge-pill bg-danger"
                                    data-key="t-hot"
                                    >Hot</span
                                >
                            </a>
                            <div
                                class="menu-dropdown collapse"
                                id="sidebarLayouts"
                                style=""
                            >
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorProfilLembaga',
                                            }"
                                            class="nav-link"
                                        >
                                            Profil Lembaga / Pimpinan
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorRab',
                                            }"
                                            class="nav-link"
                                        >
                                            Rencana Anggaran Biaya
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorBerita',
                                            }"
                                            class="nav-link"
                                        >
                                            Berita
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorPengumuman',
                                            }"
                                            class="nav-link"
                                        >
                                            Pengumuman
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorPanduan',
                                            }"
                                            class="nav-link"
                                        >
                                            Panduan
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorTautan',
                                            }"
                                            class="nav-link"
                                        >
                                            Tautan
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorSponsor',
                                            }"
                                            class="nav-link"
                                        >
                                            Sponsor
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- end Dashboard Menu -->

                        <li class="nav-item">
                            <a
                                class="nav-link menu-link collapsed"
                                href="#sidebarAuth"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarAuth"
                            >
                                <i class="ri-account-circle-line"></i>
                                <span data-key="t-authentication"
                                    >Pengelolaan Review</span
                                >
                            </a>
                            <div
                                class="collapse menu-dropdown"
                                id="sidebarAuth"
                            >
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorBorangPenilaian',
                                            }"
                                            class="nav-link"
                                        >
                                            Borang Penilaian
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorDaftarReviewer',
                                            }"
                                            class="nav-link"
                                        >
                                            Daftar Reviewer
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorReviewerExternal',
                                            }"
                                            class="nav-link"
                                        >
                                            Reviewer External
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorPenugasanReview',
                                            }"
                                            class="nav-link"
                                        >
                                            Penugasan Reviewer
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorPlotingReviewer',
                                            }"
                                            class="nav-link"
                                        >
                                            Ploting Reviewer
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            :to="{
                                                name: 'OperatorMonitoringPenilaian',
                                            }"
                                            class="nav-link"
                                        >
                                            Monitoring Penilaian
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
    </div>
</template>
