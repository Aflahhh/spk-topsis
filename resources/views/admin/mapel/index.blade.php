@extends('admin.layout.main')

@section('content')
    <div class="card rounded-4" style="height: 90px">
        <div class="card-body mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title" style="font-size: 24px;">Data Mata Pelajaran</h5>
                <div class="d-flex">
                    <!-- Plus Button -->
                    <button type="button" class="btn btn-primary rounded-3 ms-2" data-bs-toggle="modal"
                        data-bs-target="#modalTambah">
                        Tambah Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal tambah --}}
    <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Data Mata Pelajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <form action="{{ route('mapel.tambah') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row mb-3">
                            <label for="mapel" class="col-sm-4 col-form-label text-nowrap">Mata Pelajaran</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mapel" name="mapel" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
    {{-- end modal tambah --}}

    {{-- modal edit --}}
    @foreach ($mapels as $mapel)
        <div class="modal fade" id="modalEdit{{ $mapel->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel">Edit Data Mata Pelajaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="{{ route('mapel.edit', $mapel->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Gunakan PUT untuk update data -->
                        <div class="modal-body">
                            <div class="row mb-3">
                                <label for="mapel" class="col-sm-4 col-form-label text-nowrap">Mata Pelajaran</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mapel" name="mapel"
                                        value="{{ $mapel->mapel }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- modal edit --}}

    {{-- modal hapus --}}
    @foreach ($mapels as $mapel)
        <div class="modal fade" id="hapus{{ $mapel->id }}" tabindex="-1" aria-labelledby="hapusModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hapusModalLabel">Hapus Data Mata Pelajaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('mapel.hapus', $mapel->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-body">
                            <i>Apakah Anda Yakin Ingin Menghapus Data <strong>{{ $mapel->mapel }}?</strong></i>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    {{-- end modal hapus --}}

    <div class="card rounded-4">
        <div class="card-body mt-3">
            <div style="overflow-x:auto;">
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mata Pelajaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mapels as $mapel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mapel->mapel }}</td>
                                <td>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $mapel->id }}">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#hapus{{ $mapel->id }}"> <i class="bi bi-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
