<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use App\Models\jawaban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GuruController extends Controller
{
    public function index() {
        $matchingRecords = Soal::join('jawabans', 'soals.id', '=', 'jawabans.soal_id')
            ->select('soals.id', 'soals.isi_soal', 'jawabans.isi_jawaban')
            ->get();
        $data = [];
        if ($matchingRecords->count() > 0) {
            foreach ($matchingRecords as $record) {
                $isiSoal = $record->isi_soal;
                $isiJawaban = $record->isi_jawaban;
                if (!isset($data[$isiSoal])) {
                    $data[$isiSoal] = [];
                }
                $data[$isiSoal][] = $isiJawaban;
            }
            
            return view('guru.demo', compact('data'));    
        } else {
            echo "Data tidak ada";
        }
    }


}
