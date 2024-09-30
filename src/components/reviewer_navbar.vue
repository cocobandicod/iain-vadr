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
                                            Analytics
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
                        <!-- end Dashboard Menu -->

                        <li class="nav-item">
                            <a
                                class="nav-link menu-link"
                                href="#sidebarLanding"
                                data-bs-toggle="collapse"
                                role="button"
                                aria-expanded="false"
                                aria-controls="sidebarLanding"
                            >
                                <i class="ri-rocket-line"></i>
                                <span data-key="t-landing">Landing</span>
                            </a>
                            <div
                                class="collapse menu-dropdown"
                                id="sidebarLanding"
                            >
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a
                                            href="landing.html"
                                            class="nav-link"
                                            data-key="t-one-page"
                                        >
                                            One Page
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="nft-landing.html"
                                            class="nav-link"
                                            data-key="t-nft-landing"
                                        >
                                            NFT Landing
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a
                                            href="job-landing.html"
                                            class="nav-link"
                                            data-key="t-job"
                                            >Job</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="widgets.html">
                                <i class="ri-honour-line"></i>
                                <span data-key="t-widgets">Widgets</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
    </div>
</template>
