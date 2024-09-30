<script setup>
import GlobalHeader from "./operator_header.vue";
</script>
<template>
    <GlobalHeader />
    <div>
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index-2.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img
                            src="/src/assets/images/logo-sm.png"
                            alt=""
                            height="25"
                        />
                    </span>
                    <span class="logo-lg">
                        <img
                            src="/src/assets/images/logo-dark.png"
                            alt=""
                            height="25"
                        />
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index-2.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img
                            src="/src/assets/images/logo-sm.png"
                            alt=""
                            height="25"
                        />
                    </span>
                    <span class="logo-lg">
                        <img
                            src="/src/assets/images/logo-light.png"
                            alt=""
                            height="25"
                        />
                    </span>
                </a>
                <button
                    type="button"
                    class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover"
                >
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title">
                            <span data-key="t-menu">Menu</span>
                        </li>
                        <!--
                        <li class="nav-item">
                            <a
                                class="nav-link menu-link"
                                href="#sidebarDashboards"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarDashboards"
                            >
                                <i class="ri-dashboard-2-line"></i>
                                <span data-key="t-dashboards">Dashboards</span>
                            </a>
                            <div
                                class="collapse menu-dropdown"
                                id="sidebarDashboards"
                            >
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a
                                            href="dashboard-analytics.html"
                                            class="nav-link"
                                            data-key="t-analytics"
                                        >
                                            pengusulan
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="dashboard-crm.html"
                                            class="nav-link"
                                            data-key="t-crm"
                                        >
                                            CRM
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        -->
                        <!-- end Dashboard Menu -->

                        <li class="nav-item">
                            <router-link
                                type="button"
                                :to="`/pengusul/dashboard`"
                                class="nav-link menu-link"
                                :class="{
                                    active: isActive('/pengusul/dashboard'),
                                }"
                            >
                                <i class="ri-home-3-line"></i>
                                <span data-key="t-widgets">Dashboard</span>
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link menu-link"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarLanding"
                            >
                                <i class="ri-book-2-line"></i>
                                <span data-key="t-landing">Penelitian</span>
                            </a>
                            <div
                                class="collapse menu-dropdown"
                                id="sidebarLanding"
                            >
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <router-link
                                            type="button"
                                            :to="`/pengusul/penelitian/usulan-baru`"
                                            class="nav-link"
                                            :class="{
                                                active: isActive(
                                                    '/pengusul/penelitian/usulan-baru'
                                                ),
                                            }"
                                        >
                                            Usulan Baru
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            type="button"
                                            :to="`/pengusul/penelitian/perbaikan-usulan`"
                                            class="nav-link"
                                            :class="{
                                                active: isActive(
                                                    '/pengusul/penelitian/perbaikan-usulan'
                                                ),
                                            }"
                                        >
                                            Perbaikan Usulan
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            type="button"
                                            :to="`/pengusul/penelitian/laporan-kemajuan`"
                                            class="nav-link"
                                            :class="{
                                                active: isActive(
                                                    '/pengusul/penelitian/laporan-kemajuan'
                                                ),
                                            }"
                                        >
                                            Laporan Kemajuan
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            type="button"
                                            :to="`/pengusul/penelitian/laporan-akhir`"
                                            class="nav-link"
                                            :class="{
                                                active: isActive(
                                                    '/pengusul/penelitian/laporan-akhir'
                                                ),
                                            }"
                                        >
                                            Laporan Akhir
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            type="button"
                                            :to="`/pengusul/penelitian/catatan-harian`"
                                            class="nav-link"
                                            :class="{
                                                active: isActive(
                                                    '/pengusul/penelitian/catatan-harian'
                                                ),
                                            }"
                                        >
                                            Catatan Harian
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a
                                class="nav-link menu-link"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarLanding"
                            >
                                <i class="ri-book-2-line"></i>
                                <span data-key="t-landing">Pengabdian</span>
                            </a>
                            <div
                                class="collapse menu-dropdown"
                                id="sidebarLanding"
                            >
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <router-link
                                            type="button"
                                            :to="`/pengusul/pengabdian/usulan-baru`"
                                            class="nav-link"
                                            :class="{
                                                active: isActive(
                                                    '/pengusul/pengabdian/usulan-baru'
                                                ),
                                            }"
                                        >
                                            Usulan Baru
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            type="button"
                                            :to="`/pengusul/pengabdian/perbaikan-usulan`"
                                            class="nav-link"
                                            :class="{
                                                active: isActive(
                                                    '/pengusul/pengabdian/perbaikan-usulan'
                                                ),
                                            }"
                                        >
                                            Perbaikan Usulan
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            type="button"
                                            :to="`/pengusul/pengabdian/laporan-kemajuan`"
                                            class="nav-link"
                                            :class="{
                                                active: isActive(
                                                    '/pengusul/pengabdian/laporan-kemajuan'
                                                ),
                                            }"
                                        >
                                            Laporan Kemajuan
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            type="button"
                                            :to="`/pengusul/pengabdian/laporan-akhir`"
                                            class="nav-link"
                                            :class="{
                                                active: isActive(
                                                    '/pengusul/pengabdian/laporan-akhir'
                                                ),
                                            }"
                                        >
                                            Laporan Akhir
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link
                                            type="button"
                                            :to="`/pengusul/pengabdian/catatan-harian`"
                                            class="nav-link"
                                            :class="{
                                                active: isActive(
                                                    '/pengusul/pengabdian/catatan-harian'
                                                ),
                                            }"
                                        >
                                            Catatan Harian
                                        </router-link>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <router-link
                                type="button"
                                :to="`/pengusul/insentif`"
                                class="nav-link menu-link"
                                :class="{
                                    active: isActive('/pengusul/insentif'),
                                }"
                            >
                                <i class="ri-bank-card-line"></i>
                                <span data-key="t-widgets">Insentif</span>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link
                                type="button"
                                :to="`/pengusul/download`"
                                class="nav-link menu-link"
                                :class="{
                                    active: isActive('/pengusul/download'),
                                }"
                            >
                                <i class="ri-file-download-line"></i>
                                <span data-key="t-widgets">Download</span>
                            </router-link>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
        isActive(route) {
            return this.$route.path === route;
        },
    },
};
</script>
