@extends('admin.layout.main')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-4">
    {{-- Data Pegawai --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>DATA PEGAWAI</strong>
        </div>
        <div class="card-body mt-3">
            <div class="row justify-content-center">
                <div class="col-10">
                    <div class="row mb-3">
                        <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                        <div class="col-sm-10">
                            <span class="px-3">:</span>{{ $pegawai->nip }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nama_pegawai" class="col-sm-2 col-form-label">Nama Pegawai</label>
                        <div class="col-sm-10">
                            <span class="px-3">:</span>{{ $pegawai->nama_pegawai }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="mapel" class="col-sm-2 col-form-label">Mata Pelajaran</label>
                        <div class="col-sm-10">
                            <span class="px-3">:</span>{{ $pegawai->mapel->mapel }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Penilaian Kinerja --}}
    <div class="card">
        <div class="card-header bg-primary text-white">
            <strong>SUPERVISI PENILAIAN KINERJA</strong>
        </div>
        <div class="card-body mt-3">
            <table class="table table-bordered text-center">
                <thead>
                    <tr class="table-primary">
                        <th rowspan="2" colspan="2" class="align-middle">Aspek yang Diamati</th>
                        <th colspan="4" class="align-middle">Skor</th>
                    </tr>
                    <tr class="table-light">
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($kriterias as $kriteria)
                    <tr>
                        <th colspan="2" class="text-start"><span class="ms-3">{{ $kriteria->nama_kriteria }}</span></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($kriteria->subkriterias as $index => $subkriteria)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start">{{ $subkriteria->nama_subkriteria }}</td>
                            <td><input type="radio" name="nilai[{{ $subkriteria->id }}]" value="1" {{ $subkriteria->getBobot($pegawai_id) == 1.00 ? 'checked' : '' }} disabled></td>
                            <td><input type="radio" name="nilai[{{ $subkriteria->id }}]" value="2" {{ $subkriteria->getBobot($pegawai_id) == 2.00 ? 'checked' : '' }} disabled></td>
                            <td><input type="radio" name="nilai[{{ $subkriteria->id }}]" value="3" {{ $subkriteria->getBobot($pegawai_id) == 3.00 ? 'checked' : '' }} disabled></td>
                            <td><input type="radio" name="nilai[{{ $subkriteria->id }}]" value="4" {{ $subkriteria->getBobot($pegawai_id) == 4.00 ? 'checked' : '' }} disabled></td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('export.pdf', $pegawai->id) }}" class="btn btn-danger">
        <i class="fas fa-file-pdf"></i> Export PDF
    </a>
</div>

@endsection
