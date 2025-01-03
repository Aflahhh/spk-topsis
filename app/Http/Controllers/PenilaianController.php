<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Nilai;
use App\Models\Pegawai;
use App\Models\Kriteria;
use Barryvdh\DomPDF\PDF;
use App\Models\Penilaian;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use App\Models\KriteriaPegawai;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PenilaianController extends Controller
{
    public function index()
{
    // Ambil data penilaian dengan relasi pegawai dan subkriteria
    $pegawais = Pegawai::get();

    // Ambil data subkriteria untuk modal tambah
    $kriterias = Kriteria::all();

    // Return view dengan data penilaian dan subkriteria
    return view('admin.kinerja.penilaian.index', compact('pegawais', 'kriterias'));
}

    public function edit(Request $request, $id)
    {
        $pegawai = Pegawai::where('id', $id)->first();
        $kriterias = Kriteria::with('subkriterias')->get();
        $pegawai_id = $id;

        return view('admin.kinerja.penilaian.edit', compact('pegawai', 'kriterias', 'pegawai_id'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'nilai' => 'required|array',
    ]);

    foreach ($validated['nilai'] as $subkriteria_id => $bobot) {
        KriteriaPegawai::updateOrCreate(
            [
                'pegawai_id' => $request->pegawai_id,
                'subkriteria_id' => $subkriteria_id,
            ],
            [
                'bobot' => $bobot,
            ]
        );
    }

    return redirect('/kinerja/penilaian')->with('success', 'Penilaian berhasil disimpan.');
}

public function peringkat(Request $request)
{
    // Ambil semua data pegawai
    $pegawais = Pegawai::all();

    // Urutkan pegawai berdasarkan skor (desc)
    $pegawais = $pegawais->sortByDesc(function ($pegawai) {
        return $pegawai->getSkor();
    });

    // Ambil data kriteria untuk modal tambah
    $kriterias = Kriteria::all();

    // Return view dengan data pegawai yang sudah diurutkan
    return view('admin.kinerja.penilaian.peringkat', compact('pegawais', 'kriterias'));
}

   public function peringkatDetail(Request $request, $id)
    {
        $pegawai = Pegawai::where('id', $id)->first();
        $kriterias = Kriteria::with('subkriterias')->get();
        $pegawai_id = $id;

        return view('admin.kinerja.penilaian.show', compact('pegawai', 'kriterias', 'pegawai_id'));
    }

    public function getPegawaiByNbm(Request $request)
    {
        $Nbm = $request->query('Nbm');
        $pegawai = Pegawai::where('Nbm', $Nbm)->first();

        if ($pegawai) {
            return response()->json(['nama_pegawai' => $pegawai->nama_pegawai]);
        } else {
            return response()->json([], 404);
        }
    }

    // public function exportPdf($pegawaiId)
    // {
    //     // Ambil data pegawai
    //     $pegawai = Pegawai::with('mapel')->findOrFail($pegawaiId);
    
    //     // Ambil data kriteria dan sub-kriteria dengan nilai
    //     $kriterias = Kriteria::with(['subKriteria' => function ($query) use ($pegawaiId) {
    //         $query->leftJoin('kriteria_pegawais', function ($join) use ($pegawaiId) {
    //             $join->on('subkriterias.id', '=', 'kriteria_pegawais.subkriteria_id')
    //                  ->where('kriteria_pegawais.pegawai_id', $pegawaiId);
    //         })
    //         ->select('subkriterias.*', 'kriteria_pegawais.bobot as nilai');
    //     }])->get();
    
    //     // Tentukan "Sebutan" berdasarkan fungsi (Cost/Benefit)
    //     foreach ($kriterias as $kriteria) {
    //         foreach ($kriteria->subKriteria as $sub) {
    //             $sub->sebutan = $this->getSebutan($sub->nilai, $sub->fungsi);
    //         }
    //     }
    
    //     // Data untuk template
    //     $data = [
    //         'pegawai' => $pegawai,
    //         'kriterias' => $kriterias,
    //     ];
    
    //     // Render ke view dan export ke PDF
    //     $pdf = PDF::loadView('penilaian.report', $data); // Path diperbarui ke resources/views/penilaian/report.blade.php
    //     return $pdf->download('penilaian_' . $pegawai->nama_pegawai . '.pdf');
    // }
    

// Fungsi untuk menentukan sebutan berdasarkan nilai dan fungsi
private function getSebutan($nilai, $fungsi)
{
    if ($fungsi === 'Benefit') {
        if ($nilai <= 2) return 'Buruk';
        if ($nilai <= 4) return 'Cukup';
        return 'Baik';
    } elseif ($fungsi === 'Cost') {
        if ($nilai <= 2) return 'Baik';
        if ($nilai <= 4) return 'Cukup';
        return 'Buruk';
    }
    return 'N/A'; // Jika fungsi tidak diketahui
}
}
