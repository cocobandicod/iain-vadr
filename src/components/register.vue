<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import api from "../api"; // Sesuaikan dengan path api Anda
import { thnsekarang } from "../utils/globalFunctions";

//init router
const router = useRouter();

//define state
const name = ref("");
const email = ref("");
const username = ref("");
const password = ref("");
const errors = ref([]);

//method "storeRegister"
const storeRegister = async () => {
    //init formData
    let formData = new FormData();

    //assign state value to formData
    formData.append("name", name.value);
    formData.append("email", email.value);
    formData.append("username", username.value);
    formData.append("password", password.value);

    //store data with API
    await api
        .post("/api/register", formData)
        .then(() => {
            //redirect
            router.push({ path: "/login" });
        })
        .catch((error) => {
            //assign response error data to state "errors"
            errors.value = error.response.data;
        });
};
</script>

<template>
    <div class="auth-page-wrapper pt-5">
        <div class="auth-page-content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <img
                                        src="/src/assets/images/logo-dark.png"
                                        height="30"
                                    />
                                    <h5 class="text-primary pt-3">
                                        Selamat Datang di Aplikasi Paluwala
                                    </h5>
                                    <p class="text-muted">
                                        Penelitian, Pengabdian, Luaran,
                                        Pengawasan dan Tata Kelola<br />
                                        Universitas Negeri Gorontalo
                                    </p>
                                </div>
                                <div class="p-2 mt-0">
                                    <form @submit.prevent="storeRegister()">
                                        <div class="mb-3">
                                            <label class="form-label"
                                                >Nama Pengguna</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="name"
                                                placeholder="Nama Pengguna"
                                                required
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"
                                                >Email</label
                                            >
                                            <input
                                                type="email"
                                                class="form-control"
                                                v-model="email"
                                                placeholder="Email Pengguna"
                                                required
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label"
                                                >Username</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                v-model="username"
                                                placeholder="Enter username"
                                                required
                                            />
                                        </div>

                                        <div class="mb-3">
                                            <label
                                                class="form-label"
                                                for="password-input"
                                                >Password</label
                                            >
                                            <div
                                                class="position-relative auth-pass-inputgroup mb-3"
                                            >
                                                <input
                                                    type="password"
                                                    class="form-control pe-5 password-input"
                                                    placeholder="Enter password"
                                                    v-model="password"
                                                    required
                                                />
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button"
                                                    id="password-addon"
                                                >
                                                    <i
                                                        class="ri-eye-fill align-middle"
                                                    ></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                value=""
                                                id="auth-remember-check"
                                            />
                                            <label
                                                class="form-check-label"
                                                for="auth-remember-check"
                                                >Remember me</label
                                            >
                                        </div>

                                        <div class="mt-4">
                                            <button
                                                class="btn btn-success w-100"
                                                type="submit"
                                            >
                                                Register
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">
                                &copy; {{ thnsekarang() }} Paluwala LPPM
                                Universitas Negeri Gorontalo
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>
