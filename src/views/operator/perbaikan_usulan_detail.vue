<script setup></script>
<template>
    <div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div
                                    class="card-header align-items-center d-flex"
                                >
                                    <h4 class="card-title mb-0 flex-grow-1">
                                        Perbaikan Usulan
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div
                                        class="alert alert-success alert-dismissible alert-label-icon rounded-label fade show"
                                        role="alert"
                                    >
                                        <i
                                            class="mdi mdi-file-pdf-box label-icon"
                                        ></i>
                                        <h5 class="mt-2 text-success">
                                            Multi-Objective Coevolutionary
                                            Optimization Method For Mutation
                                            Testing
                                        </h5>
                                    </div>
                                    <div class="row">
                                        <div
                                            class="timeline-steps aos-init aos-animate mt-3"
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
                                                    <p class="h6 mt-1 mb-1">
                                                        Substansi
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
                                                    <p class="h6 mt-1 mb-1">
                                                        RAB
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
                                                    <p class="h6 mt-1 mb-1">
                                                        Surat Kesanggupan
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
                                                    <p class="h6 mt-1 mb-1">
                                                        Konfirmasi
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div
                                    class="card-header align-items-center d-flex"
                                >
                                    <h4 class="card-title mb-0 flex-grow-1">
                                        Substansi Usulan
                                    </h4>
                                </div>
                                <div class="card-body"></div>
                            </div>
                            <div class="card">
                                <div
                                    class="card-header align-items-center d-flex"
                                >
                                    <h4 class="card-title mb-0 flex-grow-1">
                                        Catatan Reviewer
                                    </h4>
                                </div>
                                <div class="card-body"></div>
                            </div>
                            <div class="card">
                                <div
                                    class="card-header align-items-center d-flex"
                                >
                                    <h4 class="card-title mb-0 flex-grow-1">
                                        Rancangan Anggaran Biaya
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <button
                                                type="button"
                                                class="btn btn-success mb-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#FormUsulanBaru"
                                            >
                                                <i
                                                    class="ri-add-circle-line align-bottom me-1"
                                                ></i>
                                                Tambah
                                            </button>
                                        </div>
                                        <!--end col-->
                                        <div class="col-sm-4 ms-auto">
                                            <select
                                                class="form-select"
                                                aria-label="Default select example"
                                            >
                                                <option>Tahun ke 1</option>
                                                <option>Tahun ke 2</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4 ms-auto">
                                            <select
                                                class="form-select"
                                                aria-label="Default select example"
                                            >
                                                <option selected>
                                                    Pilih Kelompok RAB ---
                                                </option>
                                                <option value="1">Bahan</option>
                                                <option value="1">
                                                    Pengumpulan Data
                                                </option>
                                                <option value="2">
                                                    Sewa Peralatan
                                                </option>
                                                <option value="3">
                                                    Analisis Data
                                                </option>
                                                <option value="">
                                                    Pelaporan Hasil Penelitian
                                                    dan Luaran Wajib
                                                </option>
                                            </select>
                                        </div>
                                        <!--end col-->
                                    </div>
                                    <table
                                        class="table table-striped table-bordered"
                                    >
                                        <thead class="table-light">
                                            <tr>
                                                <th>Kelompok RAB</th>
                                                <th>Komponen</th>
                                                <th>Item</th>
                                                <th>Satuan</th>
                                                <th>Harga Satuan</th>
                                                <th>Volume</th>
                                                <th>Total</th>
                                                <th>Aksi</th>
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
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h5>Surat Kesanggupan</h5>
                                    <p>Dokumen Surat Kesanggupan Penelitian</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang=""></style>
