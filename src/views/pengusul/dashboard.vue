<script setup>
import { ref, onMounted, watch } from "vue";
import api from "../../api";
import { formatTanggalsaja } from "../../utils/globalFunctions";

const profilpengusul = ref({});
//const sintaData = ref({});
const isLoading1 = ref(true);
const isLoading2 = ref(false);
const idUser = ref(localStorage.getItem("id_user"));

const fetchDataProfilPengusul = async () => {
    try {
        const response = await api.get(`/api/profilpengusul/${idUser.value}`);
        profilpengusul.value = response.data.data;
    } catch (error) {
        console.error("Error fetching profil pengusul data:", error);
    } finally {
        isLoading1.value = false;
    }
};

/*
const fetchDataSinta = async (idSinta) => {
    try {
        const response = await api.get(`/api/sinta/${idSinta}`);
        sintaData.value = response.data;
    } catch (error) {
        console.error("Error fetching Sinta data:", error);
    } finally {
        isLoading2.value = false;
    }
};
*/

onMounted(() => {
    fetchDataProfilPengusul();
});

// Mengawasi perubahan pada `profilpengusul` dan panggil `fetchDataSinta` saat `id_sinta` tersedia
/*
watch(profilpengusul, (newVal) => {
    if (newVal.id_sinta) {
        fetchDataSinta(newVal.id_sinta);
    }
});
*/
</script>

<template>
    <div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="page-title-box d-sm-flex align-items-center justify-content-between"
                            >
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">
                                        Dashboard Pengusul
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row h-100">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body bg-marketplace d-flex">
                                    <div class="row align-items-end">
                                        <div class="col-sm-8">
                                            <div class="p-3">
                                                <p class="fs-16 lh-base">
                                                    Anda dapat mengajukan usulan
                                                    terkait dengan layanan
                                                    berikut :
                                                </p>
                                                <div class="mt-3">
                                                    <div
                                                        class="btn-group btn-group-lg"
                                                    >
                                                        <router-link
                                                            type="button"
                                                            :to="`/pengusul/penelitian/usulan-baru`"
                                                            class="btn btn-success me-2"
                                                        >
                                                            <i
                                                                class="ri-user-add-line align-bottom me-1"
                                                            ></i>
                                                            Penelitian
                                                        </router-link>
                                                        <router-link
                                                            type="button"
                                                            :to="`/pengusul/pengabdian/usulan-baru`"
                                                            class="btn btn-success"
                                                        >
                                                            <i
                                                                class="ri-user-add-line align-bottom me-1"
                                                            ></i>
                                                            Pengabdian
                                                        </router-link>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="px-3">
                                                <img
                                                    src="/src/assets/images/user-illustarator-1.png"
                                                    class="img-fluid"
                                                    alt=""
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card-body-->
                            </div>
                        </div>
                        <!-- end col-->
                    </div>
                    <!-- end row-->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card card-height-100">
                                <div
                                    class="card-header align-items-center d-flex"
                                >
                                    <h4 class="card-title mb-0 flex-grow-1">
                                        Status Usulan Terakhir
                                    </h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div
                                                class="flex-grow-1 text-center mb-4"
                                            >
                                                <p class="text-muted mb-0">
                                                    Usulan Penelitian
                                                </p>
                                                <h4 class="fs-16 mb-1">
                                                    Dashboard Pengusul
                                                </h4>
                                            </div>
                                            <div
                                                class="timeline-steps aos-init aos-animate"
                                                data-aos="fade-up"
                                            >
                                                <div class="timeline-step">
                                                    <div
                                                        class="timeline-content"
                                                        data-toggle="popover"
                                                        data-trigger="hover"
                                                        data-placement="top"
                                                        title=""
                                                        data-content="And here's some amazing content. It's very engaging. Right?"
                                                        data-original-title="2003"
                                                    >
                                                        <div
                                                            class="inner-circle aktif"
                                                        ></div>
                                                        <p class="h6 mt-3 mb-1">
                                                            2003
                                                        </p>
                                                        <p
                                                            class="h6 text-muted mb-0 mb-lg-0"
                                                        >
                                                            Favland Founded
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="timeline-step">
                                                    <div
                                                        class="timeline-content"
                                                        data-toggle="popover"
                                                        data-trigger="hover"
                                                        data-placement="top"
                                                        title=""
                                                        data-content="And here's some amazing content. It's very engaging. Right?"
                                                        data-original-title="2004"
                                                    >
                                                        <div
                                                            class="inner-circle aktif"
                                                        ></div>
                                                        <p class="h6 mt-3 mb-1">
                                                            2004
                                                        </p>
                                                        <p
                                                            class="h6 text-muted mb-0 mb-lg-0"
                                                        >
                                                            Launched Trello
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="timeline-step">
                                                    <div
                                                        class="timeline-content"
                                                        data-toggle="popover"
                                                        data-trigger="hover"
                                                        data-placement="top"
                                                        title=""
                                                        data-content="And here's some amazing content. It's very engaging. Right?"
                                                        data-original-title="2005"
                                                    >
                                                        <div
                                                            class="inner-circle"
                                                        ></div>
                                                        <p class="h6 mt-3 mb-1">
                                                            2005
                                                        </p>
                                                        <p
                                                            class="h6 text-muted mb-0 mb-lg-0"
                                                        >
                                                            Launched Messanger
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="timeline-step">
                                                    <div
                                                        class="timeline-content"
                                                        data-toggle="popover"
                                                        data-trigger="hover"
                                                        data-placement="top"
                                                        title=""
                                                        data-content="And here's some amazing content. It's very engaging. Right?"
                                                        data-original-title="2010"
                                                    >
                                                        <div
                                                            class="inner-circle"
                                                        ></div>
                                                        <p class="h6 mt-3 mb-1">
                                                            2010
                                                        </p>
                                                        <p
                                                            class="h6 text-muted mb-0 mb-lg-0"
                                                        >
                                                            Open New Branch
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card card-height-100">
                                <div
                                    class="card-header align-items-center d-flex"
                                >
                                    <h4 class="card-title mb-0 flex-grow-1">
                                        Profil Anda
                                    </h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="row g-4">
                                        <div class="col-lg-2">
                                            <div
                                                v-if="isLoading1"
                                                class="d-flex justify-content-center mt-4 mb-4"
                                            >
                                                <div
                                                    class="spinner-border"
                                                    role="status"
                                                >
                                                    <span
                                                        class="visually-hidden"
                                                        >Loading...</span
                                                    >
                                                </div>
                                            </div>
                                            <div v-else class="sticky-side-div">
                                                <div
                                                    class="card ribbon-box border shadow-none right"
                                                >
                                                    <div
                                                        class="ribbon-two ribbon-two-danger"
                                                    ></div>
                                                    <img
                                                        v-if="
                                                            profilpengusul.id_scholar
                                                        "
                                                        :src="`https://scholar.googleusercontent.com/citations?view_op=view_photo&user=${profilpengusul.id_scholar}&citpid=1`"
                                                        alt="Scholar Profile Picture"
                                                        class="img-fluid rounded"
                                                    />
                                                    <div
                                                        class="position-absolute bottom-0 p-3"
                                                    ></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-10">
                                            <div
                                                v-if="isLoading2"
                                                class="d-flex justify-content-center mt-4 mb-4"
                                            >
                                                <div
                                                    class="spinner-border"
                                                    role="status"
                                                >
                                                    <span
                                                        class="visually-hidden"
                                                        >Loading...</span
                                                    >
                                                </div>
                                            </div>
                                            <div v-else>
                                                <h4>
                                                    {{
                                                        profilpengusul.user
                                                            ?.name
                                                    }}
                                                </h4>
                                                <div
                                                    class="hstack gap-3 flex-wrap"
                                                >
                                                    <div class="text-muted">
                                                        {{
                                                            profilpengusul.program_studi
                                                        }}
                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <router-link
                                                        type="button"
                                                        :to="`/pengusul/riwayat-penelitian`"
                                                        class="col-lg-3 col-sm-3 mb-4"
                                                    >
                                                        <div
                                                            class="p-2 border border-dashed rounded text-center bg-gradient bg-success bg-success-subtle"
                                                        >
                                                            <div>
                                                                <p
                                                                    class="fw-medium text-black mb-1"
                                                                >
                                                                    Penelitian
                                                                </p>
                                                                <h5
                                                                    class="fs-17 text-success mb-0"
                                                                >
                                                                    0
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </router-link>
                                                    <!-- end col -->
                                                    <router-link
                                                        type="button"
                                                        :to="`/pengusul/riwayat-pengabdian`"
                                                        class="col-lg-3 col-sm-3 mb-4"
                                                    >
                                                        <div
                                                            class="p-2 border border-dashed rounded text-center bg-gradient bg-success bg-success-subtle"
                                                        >
                                                            <div>
                                                                <p
                                                                    class="fw-medium text-black mb-1"
                                                                >
                                                                    Pengabdian
                                                                </p>
                                                                <h5
                                                                    class="fs-17 text-success mb-0"
                                                                >
                                                                    0
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </router-link>
                                                    <!-- end col -->
                                                    <div
                                                        class="col-lg-3 col-sm-3 mb-4"
                                                    >
                                                        <div
                                                            class="p-2 border border-dashed rounded text-center bg-gradient bg-success bg-success-subtle"
                                                        >
                                                            <div>
                                                                <p
                                                                    class="fw-medium mb-1"
                                                                >
                                                                    Jurnal
                                                                    Inter.
                                                                    Bereputasi
                                                                </p>
                                                                <h5
                                                                    class="fs-17 text-success mb-0"
                                                                >
                                                                    0
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <router-link
                                                        type="button"
                                                        :to="`/pengusul/form-sinta`"
                                                        class="col-lg-3 col-sm-3 mb-4"
                                                    >
                                                        <div
                                                            class="p-2 border border-dashed rounded text-center bg-gradient bg-success bg-success-subtle waves-light"
                                                        >
                                                            <div>
                                                                <p
                                                                    class="fw-medium text-black mb-1"
                                                                >
                                                                    Sinta Skor
                                                                    Overall
                                                                </p>
                                                                <h5
                                                                    class="fs-17 text-success mb-0"
                                                                >
                                                                    {{
                                                                        profilpengusul
                                                                            .sinta
                                                                            ?.sinta_score
                                                                    }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </router-link>
                                                    <!-- end col -->
                                                    <div
                                                        class="col-lg-3 col-sm-3 mb-4"
                                                    >
                                                        <div
                                                            class="p-2 border border-dashed rounded text-center bg-gradient bg-success bg-success-subtle"
                                                        >
                                                            <div>
                                                                <p
                                                                    class="fw-medium mb-1"
                                                                >
                                                                    HKI
                                                                </p>
                                                                <h5
                                                                    class="fs-17 text-success mb-0"
                                                                >
                                                                    {{
                                                                        profilpengusul
                                                                            .sinta
                                                                            ?.hki
                                                                    }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div
                                                        class="col-lg-3 col-sm-3 mb-4"
                                                    >
                                                        <div
                                                            class="p-2 border border-dashed rounded text-center bg-gradient bg-success bg-success-subtle"
                                                        >
                                                            <div>
                                                                <p
                                                                    class="fw-medium mb-1"
                                                                >
                                                                    BUKU
                                                                </p>
                                                                <h5
                                                                    class="fs-17 text-success mb-0"
                                                                >
                                                                    {{
                                                                        profilpengusul
                                                                            .sinta
                                                                            ?.buku
                                                                    }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div
                                                        class="col-lg-3 col-sm-3 mb-4"
                                                    >
                                                        <div
                                                            class="p-2 border border-dashed rounded text-center bg-gradient bg-success bg-success-subtle"
                                                        >
                                                            <div>
                                                                <p
                                                                    class="fw-medium mb-1"
                                                                >
                                                                    Sinta Skor
                                                                    3Yr
                                                                </p>
                                                                <h5
                                                                    class="fs-17 text-success mb-0"
                                                                >
                                                                    {{
                                                                        profilpengusul
                                                                            .sinta
                                                                            ?.y3r
                                                                    }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                    <div
                                                        class="col-lg-3 col-sm-3 mb-4"
                                                    >
                                                        <div
                                                            class="p-2 border border-dashed rounded text-center bg-gradient bg-success bg-success-subtle"
                                                        >
                                                            <div>
                                                                <p
                                                                    class="fw-medium mb-1"
                                                                >
                                                                    Scopus
                                                                    H-Index
                                                                </p>
                                                                <h5
                                                                    class="fs-17 text-success mb-0"
                                                                >
                                                                    {{
                                                                        profilpengusul
                                                                            .sinta
                                                                            ?.hindex
                                                                    }}
                                                                </h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end col -->
                                                </div>
                                                <!--end row-->
                                                <div
                                                    class="product-content mt-2"
                                                >
                                                    <div class="float-end">
                                                        <router-link
                                                            type="button"
                                                            :to="`/pengusul/form-identitas`"
                                                            class="btn btn-light btn-icon"
                                                        >
                                                            <i
                                                                class="ri-pencil-fill align-middle fs-16"
                                                            ></i>
                                                        </router-link>
                                                    </div>
                                                    <h5>Profil Peneliti</h5>
                                                    <div
                                                        class="hstack gap-3 flex-wrap"
                                                    >
                                                        <div class="text-muted">
                                                            Informasi Data Diri
                                                            Peneliti
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="tab-content border border-top-1 border-bottom-0 p-2 mt-2"
                                                    >
                                                        <div
                                                            class="table-responsive"
                                                        >
                                                            <table
                                                                class="table mb-0"
                                                            >
                                                                <tbody>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                            style="
                                                                                width: 200px;
                                                                            "
                                                                        >
                                                                            NIDN/NIDK
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.nidn
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row p-0"
                                                                        >
                                                                            Klaster
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.klaster
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            Institusi
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul
                                                                                    .institusi
                                                                                    ?.nama
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            Program
                                                                            Studi
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.program_studi
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            Jenjang
                                                                            Pendidikan
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.jenjang_pendidikan
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            Jabatan
                                                                            Akademik
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.jabatan_akademik
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            Alamat
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.alamat
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            Tempat
                                                                            Tanggal
                                                                            Lahir
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.tempat_lahir
                                                                            }},
                                                                            {{
                                                                                formatTanggalsaja(
                                                                                    profilpengusul?.tanggal_lahir
                                                                                )
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            No
                                                                            KTP
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.no_ktp
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            No
                                                                            Telepon
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.no_telepon
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            No
                                                                            HP
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.no_hp
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            Alamat
                                                                            Surel
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.alamat_surel
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th
                                                                            scope="row"
                                                                        >
                                                                            Website
                                                                            Personal
                                                                        </th>
                                                                        <td>
                                                                            {{
                                                                                profilpengusul.website_personal
                                                                            }}
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <!--end row-->
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
    </div>
</template>
<style>
.timeline-steps {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
}

.timeline-steps .timeline-step {
    align-items: center;
    display: flex;
    flex-direction: column;
    position: relative;
    margin: 1rem;
}

@media (min-width: 768px) {
    .timeline-steps .timeline-step:not(:last-child):after {
        content: "";
        display: block;
        border-top: 0.25rem dotted #0ab39c;
        width: 3.46rem;
        position: absolute;
        left: 7.5rem;
        top: 0.3125rem;
    }
    .timeline-steps .timeline-step:not(:first-child):before {
        content: "";
        display: block;
        border-top: 0.25rem dotted #0ab39c;
        width: 3.8125rem;
        position: absolute;
        right: 7.5rem;
        top: 0.3125rem;
    }
}

.timeline-steps .timeline-content {
    width: 10rem;
    text-align: center;
}

.timeline-steps .timeline-content .inner-circle {
    border-radius: 1.5rem;
    height: 1rem;
    width: 1rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.aktif {
    background-color: #000;
}

.timeline-steps .timeline-content .inner-circle:before {
    content: "";
    background-color: #0ab39c;
    display: inline-block;
    height: 3rem;
    width: 3rem;
    min-width: 3rem;
    border-radius: 6.25rem;
    opacity: 0.5;
}
</style>
