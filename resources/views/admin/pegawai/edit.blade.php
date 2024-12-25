@extends('admin.layout.main')

@section('content')

    <div class="pagetitle">
        <h1>Edit Data Pegawai</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pegawai.index') }}">Data Pegawai</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data" class="d-inline">
        @csrf
        @method('PUT')

        {{-- Identitas Pribadi --}}
        <div class="card rounded-4">
            <div class="card-header rounded-4">IDENTITAS</div>
            <div class="card-body">

                <div class="card-body mt-3">

                    <!-- NIP/NIK -->
                    <div class="row mb-3">
                        <label for="nip" class="col-sm-3 col-form-label" style="color: black;">NIP / NIY</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nip" name="nip"
                                value="{{ $pegawai->nip }}" required>
                        </div>
                    </div>

                    <!-- Nama Pegawai -->
                    <div class="row mb-3">
                        <label for="nama_pegawai" class="col-sm-3 col-form-label" style="color: black;">Nama Pegawai <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai"
                                value="{{ $pegawai->nama_pegawai }}" required>
                        </div>
                    </div>

                    <!-- NUPTK -->
                    <div class="row mb-3">
                        <label for="nuptk" class="col-sm-3 col-form-label" style="color: black;">NUPTK <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nuptk" name="nuptk"
                                value="{{ $pegawai->nuptk }}" required>
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="row mb-3">
                        <label for="jk" class="col-sm-3 col-form-label" style="color: black;">Jenis Kelamin <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="jk" name="jk">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-Laki" {{ $pegawai->jk == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                                </option>
                                <option value="Perempuan" {{ $pegawai->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Tempat, Tanggal Lahir -->
                    <div class="row mb-3">
                        <label for="tempat" class="col-sm-3 col-form-label" style="color: black;">Tempat, Tanggal Lahir
                            <span style="color: red;">*</span>
                        </label>
                        <div class="col-sm-5">
                            <!-- Input untuk Tempat -->
                            <input type="text" class="form-control" id="tempat" name="tempat"
                                value="{{ old('tempat', explode(', ', $pegawai->ttl)[0] ?? '') }}"
                                placeholder="Masukkan Tempat" required>
                        </div>
                        <div class="col-sm-4">
                            <!-- Input untuk Tanggal -->
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ old('tanggal_lahir', explode(', ', $pegawai->ttl)[1] ?? '') }}" required>
                        </div>
                        <!-- Input Hidden untuk TTL -->
                        <input type="hidden" id="ttl" name="ttl" value="{{ old('ttl', $pegawai->ttl) }}">
                    </div>

                    <!-- Provinsi -->
                    <div class="row mb-3">
                        <label for="prov_id" class="col-sm-3 col-form-label" style="color: black;">Provinsi <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="prov_id" name="prov_id" required>
                                <option value="">Pilih Provinsi</option>
                                @foreach ($provinces as $prov)
                                    <option value="{{ $prov->id }}"
                                        {{ $pegawai->prov_id == $prov->id ? 'selected' : '' }}>{{ $prov->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Kabupaten -->
                    <div class="row mb-3">
                        <label for="kab_id" class="col-sm-3 col-form-label" style="color: black;">Kabupaten <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="kab_id" name="kab_id" required>
                                <option value="">Pilih Kabupaten</option>
                                @foreach ($kabupaten as $kab)
                                    <option value="{{ $kab->id }}"
                                        {{ $pegawai->kab_id == $kab->id ? 'selected' : '' }}>{{ $kab->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Kecamatan -->
                    <div class="row mb-3">
                        <label for="kec_id" class="col-sm-3 col-form-label" style="color: black;">Kecamatan <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="kec_id" name="kec_id" required>
                                <option value="">Pilih Kecamatan</option>
                                @foreach ($kecamatan as $kec)
                                    <option value="{{ $kec->id }}"
                                        {{ $pegawai->kec_id == $kec->id ? 'selected' : '' }}>{{ $kec->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Desa -->
                    <div class="row mb-3">
                        <label for="desa_id" class="col-sm-3 col-form-label" style="color: black;">Kelurahan / Desa
                            <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="desa_id" name="desa_id" required>
                                <option value="">Pilih Desa</option>
                                @foreach ($desa as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $pegawai->desa_id == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="row mb-3">
                        <label for="alamat" class="col-sm-3 col-form-label" style="color: black;">Alamat <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="{{ $pegawai->alamat }}" required>
                        </div>
                    </div>

                    <!-- Nomor HP -->
                    <div class="row mb-3">
                        <label for="no_hp" class="col-sm-3 col-form-label" style="color: black;">Nomor HP <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                value="{{ $pegawai->no_hp }}" required>
                        </div>
                    </div>

                    <!-- Status Perkawinan -->
                    <div class="row mb-3">
                        <label for="status_perkawinan" class="col-sm-3 col-form-label" style="color: black;">Status
                            Perkawinan <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                                <option value="">Pilih Status Pernikahan</option>
                                <option value="Sudah Menikah"
                                    {{ $pegawai->status_perkawinan == 'Sudah Menikah' ? 'selected' : '' }}>Sudah Menikah
                                </option>
                                <option value="Belum Menikah"
                                    {{ $pegawai->status_perkawinan == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah
                                </option>
                                <option value="Pernah Menikah"
                                    {{ $pegawai->status_perkawinan == 'Pernah Menikah' ? 'selected' : '' }}>Pernah Menikah
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Tanggal Masuk -->
                    <div class="row mb-3">
                        <label for="tgl_masuk" class="col-sm-3 col-form-label" style="color: black;">Tanggal
                            Masuk</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk"
                                value="{{ $pegawai->tgl_masuk }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="tgl_keluar" class="col-sm-3 col-form-label" style="color: black;">Tanggal
                            Keluar</label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="tgl_keluar" name="tgl_keluar"
                                value="{{ $pegawai->tgl_keluar }}" required>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        {{-- Data Jabatan dan Golongan --}}
        <div class="card rounded-4">
            <div class="card-header rounded-4">DATA JABATAN</div>
            <div class="card-body">
                <div class="card-body mt-2">
                    <div class="row">
                        <label for="jabatan_id" class="col-sm-3 col-form-label " style="color: black;">Jabatan <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select name="jabatan_id" id="jabatan_id" class="form-control mt-2 mb-2" required>
                                <option value="">Pilih Jabatan</option>
                                @foreach ($jabatan as $data)
                                    <option value="{{ $data->id }}"
                                        {{ $pegawai->jabatan_id == $data->id ? 'selected' : '' }}>
                                        {{ $data->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label for="status_jabatan" class="col-sm-3 col-form-label" style="color: black;">Status jabatan
                            <span style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control mt-2 mb-2" name="status_jabatan" id="status_jabatan" required>
                                <option value="">Pilih Status Jabatan</option>
                                <option value="GTT" {{ $pegawai->status_jabatan == 'GTT' ? 'selected' : '' }}>Guru
                                    Tidak Tetap</option>
                                <option value="GTY" {{ $pegawai->status_jabatan == 'GTY' ? 'selected' : '' }}>Guru
                                    Tetap Yayasan</option>
                                <option value="DPK" {{ $pegawai->status_jabatan == 'DPK' ? 'selected' : '' }}>
                                    Diperhitungkan</option>
                            </select>

                        </div>
                    </div>

                    <div class="row">
                        <label for="golongan_id" class="col-sm-3 col-form-label" style="color: black;">Golongan <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select name="golongan_id" id="golongan_id" class="form-control mt-2 mb-2">
                                <option value="">Pilih Golongan</option>
                                @foreach ($golongan as $data)
                                    <option value="{{ $data->id }}"
                                        {{ $pegawai->golongan_id == $data->id ? 'selected' : '' }}>{{ $data->golongan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label for="mapel_id" class="col-sm-3 col-form-label" style="color: black;">Mata Pelajaran <span
                                style="color: red;">*</span></label>
                        <div class="col-sm-9">
                            <select name="mapel_id" id="mapel_id" class="form-control mt-2">
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach ($mapel as $data)
                                    <option value="{{ $data->id }}"
                                        {{ $pegawai->mapel_id == $data->id ? 'selected' : '' }}>{{ $data->mapel }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Riwayat Pendidikan --}}
        <div class="card rounded-4">
            <div class="card-header rounded-4">RIWAYAT PENDIDIKAN</div>
            <div class="card-body mt-2">
                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">
                                <button type="button" class="btn btn-outline-success btn-sm" id="add-row"
                                    style="background-color: #4CAF50; color: white; border-color: #4CAF50;">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </th>
                            <th style="text-align: center; width: 150px">Tahun Masuk</th>
                            <th style="text-align: center; width: 150px">Tahun Lulus</th>
                            <th style="text-align: center; width: 150px">Nama Sekolah/Instansi Pendidikan Lainnya</th>
                            <th style="text-align: center; width: 150px">Jurusan</th>
                        </tr>
                    </thead>
                    <tbody id="education-history">
                        <!-- Loop for existing education data -->
                        @foreach ($pegawai->pendidikan as $pendidikan)
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="pendidikan_masuk[]"
                                        value="{{ old('pendidikan_masuk', $pendidikan->pendidikan_masuk) }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="pendidikan_keluar[]"
                                        value="{{ old('pendidikan_keluar', $pendidikan->pendidikan_masuk) }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="nama_sekolah[]"
                                        value="{{ old('nama_sekolah', $pendidikan->nama_sekolah) }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="pendidikan_jurusan[]"
                                        value="{{ old('pendidikan_jurusan', $pendidikan->pendidikan_jurusan) }}" required>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <script>
                    // Function to add a new row
                    document.getElementById('add-row').addEventListener('click', function() {
                        var table = document.getElementById('education-history');
                        var newRow = `
                        <tr>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-row">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                            <td><input type="text" class="form-control" name="pendidikan_masuk[]" placeholder="" required></td>
                            <td><input type="text" class="form-control" name="pendidikan_keluar[]" placeholder="" required></td>
                            <td><input type="text" class="form-control" name="nama_sekolah[]" placeholder="" required></td>
                            <td><input type="text" class="form-control" name="pendidikan_jurusan[]" placeholder="" required></td>
                        </tr>
                    `;
                        table.insertAdjacentHTML('beforeend', newRow);
                    });

                    // Function to remove a row
                    document.addEventListener('click', function(e) {
                        if (e.target && e.target.closest('.remove-row')) {
                            e.target.closest('tr').remove();
                        }
                    });
                </script>
            </div>
        </div>


        {{-- Riwayat Pekerjaan --}}
        <div class="card rounded-4">
            <div class="card-header rounded-4">RIWAYAT PEKERJAAN</div>
            <div class="card-body">
                <div class="alert alert-info mt-2 mb-1" style="font-size: 0.85em;">
                    <li>pekerjaan Keluar tidak perlu diisi jika masih bekerja di perusahaan / instansi yang terkait.</li>
                </div>

                <table class="table table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 50px;">
                                <button type="button" class="btn btn-outline-success btn-sm" id="add-job-row"
                                    style="background-color: #4CAF50; color: white; border-color: #4CAF50;">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </th>
                            <th style="text-align: center; width: 150px;">Tahun Masuk</th>
                            <th style="text-align: center; width: 150px">Tahun Keluar</th>
                            <th style="text-align: center; width: 150px">Perusahaan/Instansi</th>
                            <th style="text-align: center; width: 150px">Posisi</th>
                        </tr>
                    </thead>
                    <tbody id="job-history"> <!-- Pastikan ID ini konsisten -->
                        <!-- Loop for existing job history data -->
                        @foreach ($pegawai->pekerjaan as $pekerjaan)
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-job-row">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="pekerjaan_masuk[]"
                                        value="{{ $pekerjaan->pekerjaan_masuk }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="pekerjaan_keluar[]"
                                        value="{{ $pekerjaan->pekerjaan_keluar }}">
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="nama_perusahaan[]"
                                        value="{{ $pekerjaan->nama_perusahaan }}" required>
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="posisi[]"
                                        value="{{ $pekerjaan->posisi }}" required>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Function to add a new row for job history --}}
                <script>
                    document.getElementById('add-job-row').addEventListener('click', function() {
                        var table = document.getElementById('job-history'); // Pastikan ID sesuai
                        var newRow = `
                        <tr>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-job-row">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="pekerjaan_masuk[]" placeholder="" required>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="pekerjaan_keluar[]" placeholder="">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="nama_perusahaan[]" placeholder="" required>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="posisi[]" placeholder="" required>
                            </td>
                        </tr>
                    `;
                        table.insertAdjacentHTML('beforeend', newRow);
                    });
                    // Function to remove a job row
                    document.addEventListener('click', function(e) {
                        if (e.target && e.target.closest('.remove-job-row')) {
                            e.target.closest('tr').remove();
                        }
                    });

                    // Function to preview the uploaded image
                    function previewImage(event) {
                        const image = document.getElementById('profile-image');
                        const file = event.target.files[0];

                        if (file) {
                            // Validate file size (Max 1 MB)
                            if (file.size > 1048576) { // 1 MB = 1048576 bytes
                                alert('File size must not exceed 1 MB.');
                                event.target.value = ""; // Reset file input
                                return;
                            }

                            // Update image preview
                            image.src = URL.createObjectURL(file);
                            image.onload = () => {
                                URL.revokeObjectURL(image.src); // Free up memory
                            };
                        }
                    }

                    // Function to reset the image preview to default
                    function resetImage() {
                        const image = document.getElementById('profile-image');
                        const inputFile = document.getElementById('upload');

                        // Reset the file input
                        inputFile.value = "";

                        // Set image back to default or existing photo
                        image.src = "{{ asset('storage/' . $pegawai->foto) }}" || 'assets/img/pp.jpg';
                    }


                    function calculateExitDate() {
                        const ttl = document.getElementById('ttl').value; // Ambil nilai dari input dengan id "ttl"
                        if (ttl) {
                            // Pisahkan tempat dan tanggal menggunakan ", "
                            const [tempat, tanggal] = ttl.split(', ');

                            // Parsing tanggal lahir
                            const birthDate = new Date(tanggal);

                            if (!isNaN(birthDate)) { // Pastikan tanggal valid
                                // Tambahkan 60 tahun untuk menghitung tanggal pensiun
                                birthDate.setFullYear(birthDate.getFullYear() + 60);

                                // Format tanggal menjadi "YYYY-MM-DD"
                                const exitDate = birthDate.toISOString().split('T')[0];

                                // Set nilai ke input dengan id "tgl_keluar"
                                document.getElementById('tgl_keluar').value = exitDate;
                            } else {
                                console.error('Format tanggal pada TTL tidak valid.');
                            }
                        }
                    }


                    window.onload = function() {
                        // Automatically populate tgl_masuk with today's date if it's empty
                        const tglMasukField = document.getElementById('tgl_masuk');
                        if (!tglMasukField.value) {
                            tglMasukField.value = new Date().toISOString().split('T')[0]; // Current date in YYYY-MM-DD format
                        }

                        // Trigger the calculation of the retirement date if ttl exists
                        const ttlField = document.getElementById('ttl');
                        if (ttlField.value) {
                            calculateExitDate();
                        }
                    }
                </script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        // Gabungkan tempat dan tanggal lahir ke input hidden 'ttl' saat salah satu berubah
                        $('#tanggal_lahir').on('change', function() {
                            const tempat = $('#tempat').val(); // Ambil nilai tempat
                            const tanggal = $(this).val(); // Ambil nilai tanggal

                            if (tempat && tanggal) {
                                const ttl = `${tempat}, ${tanggal}`; // Gabungkan tempat dan tanggal
                                $('#ttl').val(ttl); // Set nilai ke input hidden
                            }
                        });
                    });
                </script>
            </div>
        </div>

        <div class="modal-footer">
            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary me-2">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

    </form>

@endsection