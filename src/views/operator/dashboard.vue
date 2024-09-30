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
                                        Dashboard Operator
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
                                                <p class="fs-24 lh-base">
                                                    Universitas Negeri Gorontalo
                                                </p>
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
                                        Monitoring Usulan
                                    </h4>
                                </div>
                                <!-- end card header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xxl-3 col-md-3 mt-2">
                                            <div>
                                                <label
                                                    for="labelInput"
                                                    class="form-label"
                                                    >Jenis Kegiatan</label
                                                >
                                                <select class="form-select">
                                                    <option value="Penelitian">
                                                        Penelitian
                                                    </option>
                                                    <option value="Pengabdian">
                                                        Penelitian
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-5 col-md-5 mt-2">
                                            <div>
                                                <label
                                                    for="labelInput"
                                                    class="form-label"
                                                    >Program Hibah</label
                                                >
                                                <select class="form-select">
                                                    <option value="Penelitian">
                                                        Penelitian
                                                    </option>
                                                    <option value="Pengabdian">
                                                        Penelitian
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-md-3 mt-2">
                                            <div>
                                                <label
                                                    for="labelInput"
                                                    class="form-label"
                                                    >Tahun Pelaksanaan</label
                                                >
                                                <select class="form-select">
                                                    <option value="2024">
                                                        2024
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="row row-cols-md-3 row-cols-1 mt-4 mb-4"
                                    >
                                        <div class="col col-lg border-end">
                                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                                <h5
                                                    class="text-muted text-uppercase fs-13"
                                                >
                                                    Usulan Draf
                                                </h5>
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <div class="flex-shrink-0">
                                                        <i
                                                            class="ri-file-edit-line display-6 text-muted"
                                                        ></i>
                                                    </div>
                                                    <div
                                                        class="flex-grow-1 ms-3"
                                                    >
                                                        <h2 class="mb-0">
                                                            <span
                                                                class="counter-value"
                                                                data-target="197"
                                                                >0</span
                                                            >
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col col-lg border-end">
                                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                                <h5
                                                    class="text-muted text-uppercase fs-13"
                                                >
                                                    Usulan Dikirim
                                                </h5>
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <div class="flex-shrink-0">
                                                        <i
                                                            class="ri-send-plane-line display-6 text-muted"
                                                        ></i>
                                                    </div>
                                                    <div
                                                        class="flex-grow-1 ms-3"
                                                    >
                                                        <h2 class="mb-0">
                                                            <span
                                                                class="counter-value"
                                                                >0</span
                                                            >
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col col-lg border-end">
                                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                                <h5
                                                    class="text-muted text-uppercase fs-13"
                                                >
                                                    Usulan Belum Ditinjau
                                                </h5>
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <div class="flex-shrink-0">
                                                        <i
                                                            class="ri-file-list-3-line display-6 text-muted"
                                                        ></i>
                                                    </div>
                                                    <div
                                                        class="flex-grow-1 ms-3"
                                                    >
                                                        <h2 class="mb-0">
                                                            <span
                                                                class="counter-value"
                                                                >0</span
                                                            >
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col col-lg border-end">
                                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                                <h5
                                                    class="text-muted text-uppercase fs-13"
                                                >
                                                    Usulan Disetujui
                                                </h5>
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <div class="flex-shrink-0">
                                                        <i
                                                            class="ri-checkbox-circle-line display-6 text-muted"
                                                        ></i>
                                                    </div>
                                                    <div
                                                        class="flex-grow-1 ms-3"
                                                    >
                                                        <h2 class="mb-0">
                                                            <span
                                                                class="counter-value"
                                                                >0</span
                                                            >
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                        <div class="col col-lg">
                                            <div class="mt-3 mt-lg-0 py-4 px-3">
                                                <h5
                                                    class="text-muted text-uppercase fs-13"
                                                >
                                                    Usulan Ditolak
                                                </h5>
                                                <div
                                                    class="d-flex align-items-center"
                                                >
                                                    <div class="flex-shrink-0">
                                                        <i
                                                            class="ri-delete-back-2-line display-6 text-muted"
                                                        ></i>
                                                    </div>
                                                    <div
                                                        class="flex-grow-1 ms-3"
                                                    >
                                                        <h2 class="mb-0">
                                                            <span
                                                                class="counter-value"
                                                                >0</span
                                                            >
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <div class="row">
                                        <h5>Rekap Usulan</h5>
                                        <div class="col">
                                            <div class="table-responsive">
                                                <table
                                                    class="table table-bordered dt-responsive table-striped align-middle fs-12 mb-0"
                                                    style="width: 100%"
                                                >
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th
                                                                style="
                                                                    width: 3%;
                                                                "
                                                                class="text-center"
                                                            >
                                                                No
                                                            </th>
                                                            <th>Nama Skema</th>
                                                            <th>Usulan Draf</th>
                                                            <th>
                                                                Usulan Dikirim
                                                            </th>
                                                            <th>
                                                                Usulan Disetujui
                                                            </th>
                                                            <th>
                                                                Usulan Ditolak
                                                            </th>
                                                            <th>
                                                                Usulan Lolos
                                                            </th>
                                                            <th>
                                                                Usulan Tidak
                                                                Lolos
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
        </div>
    </div>
</template>
<script></script>
