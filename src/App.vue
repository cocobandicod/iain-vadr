<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";
import GlobalNavbar from "./components/navbar.vue";
import PengusulNavbar from "./components/pengusul_navbar.vue";
import ReviewerNavbar from "./components/reviewer_navbar.vue";
import OperatorNavbar from "./components/operator_navbar.vue";
import OperatorFooter from "./components/operator_footer.vue";

const route = useRoute();
const isLoginPage = computed(() => route.path === "/login");
const isRegisterPage = computed(() => route.path === "/register");
const isOperatorPage = computed(() => route.path.startsWith("/operator"));
const isPengusulPage = computed(() => route.path.startsWith("/pengusul"));
const isReviewerPage = computed(() => route.path.startsWith("/reviewer"));
const isNotFoundPage = computed(() => route.name === "NotFound");
</script>

<template>
    <div>
        <!-- Tampilkan navbar jika bukan halaman login, operator, atau not found -->
        <div
            v-if="
                !isLoginPage &&
                !isRegisterPage &&
                !isPengusulPage &&
                !isOperatorPage &&
                !isNotFoundPage
            "
        >
            <GlobalNavbar />
        </div>

        <!-- Tampilkan layout peneliti jika halaman peneliti -->
        <div v-else-if="isPengusulPage && !isNotFoundPage">
            <PengusulNavbar />
        </div>

        <!-- Tampilkan layout Reviewer jika halaman Reviewer -->
        <div v-else-if="isReviewerPage && !isNotFoundPage">
            <ReviewerNavbar />
        </div>

        <!-- Tampilkan layout operator jika halaman operator -->
        <div v-else-if="isOperatorPage && !isNotFoundPage">
            <OperatorNavbar />
        </div>

        <!-- Render router view -->
        <router-view></router-view>

        <!-- Tampilkan layout operator jika halaman operator -->
        <div
            v-if="
                (isOperatorPage || isPengusulPage || isReviewerPage) &&
                !isNotFoundPage
            "
        >
            <OperatorFooter />
        </div>
    </div>
</template>
