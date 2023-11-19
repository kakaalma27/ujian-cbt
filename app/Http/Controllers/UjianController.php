<?php

namespace App\Http\Controllers;
use App\Models\Soal;
use App\Models\kelas;
use App\Models\jawaban;
use App\Models\pelajaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function index()
    {
        $pelajarans = Pelajaran::with('user')
        ->whereHas('user', function ($query) {
            $query->where('role', 1);
        })
        ->get();

        $kelas = kelas::with('user')->get();

        return view('guru.crud_soal.index', compact('pelajarans', 'kelas'));
    }

    public function create()
    {
        $pelajarans = Pelajaran::with('user')
        ->whereHas('user', function ($query) {
            $query->where('role', 1);
        })
        ->get();

        $kelas = kelas::with('user')->get();
        return view('guru.crud_soal.create', compact('pelajarans', 'kelas'));
    }

    public function upload(Request $request)
    {
        DB::beginTransaction();
        try {
            $question = Soal::create([
                'user_id' => auth()->id(),
                'kelas_id' => $request->input('kelas_id'),
                'pelajaran_id' => $request->input('pelajaran_id'),
                'isi_soal' => $request->input('data.isi_soal')[0]
            ]);
    
            $jawabanArray = $request->input('data.isi_jawaban');
            $totalJawaban = count($jawabanArray);
            
            $is_correct_option = $request->input('data.isi_jawaban_correct');
            
            for ($key = 0; $key < $totalJawaban; $key++) {
                $jawabanData = $jawabanArray[$key];
                $is_correct = ($is_correct_option == $key) ? 1 : 0;
            
                Jawaban::create([
                    'soal_id' => $question->id,
                    'isi_jawaban' => $jawabanData,
                    'is_correct' => $is_correct,
                ]);
            }

            DB::commit();
    
            return response()->json(['message' => 'Data imported successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response('Error: ' . $e->getMessage(), 500);
        }
    }


    public function uploadExcal(Request $request)
    {
        DB::beginTransaction();

        try {
            $uploadedFile = $request->file('xlsx_file');
    
            $import = new Soal;
            $importedData = Excel::toArray($import, $uploadedFile);
    
            $questions = $importedData[0]; 
            $answers = $importedData[1];   
    
            // Create questions
            foreach ($questions as $questionData) {
                $question = Soal::create([
                    'user_id' => auth()->id(),
                    'kelas_id' => $request->input('kelas_id'),
                    'pelajaran_id' => $request->input('pelajaran_id'),
                    'isi_soal' => $questionData[0],
                ]);
    
                // Create answers for each question
                foreach ($answers as $key => $answerData) {
                    $is_correct = ($request->input('data.isi_jawaban_correct') == $key) ? 1 : 0;
    
                    Jawaban::create([
                        'soal_id' => $question->id,
                        'isi_jawaban' => $answerData[0], 
                        'is_correct' => $is_correct,
                    ]);
                }
            }
    
            DB::commit();
    
            return response()->json(200);
        } catch (\Exception $e) {
            DB::rollBack();
    
            return response('Error: ' . $e->getMessage(), 500);
        }
    }
}
