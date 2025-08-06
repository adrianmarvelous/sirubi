<?php

namespace App\Http\Controllers\Dashboard_Bkpsdm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class Dashboard extends Controller
{
    public function index()
    {
        return view('dashboard_bkpsdm.index');
    }
    public function view_jadwal_rapat(Request $request)
    {
        if(isset($request->tanggal_filter) && $request->tanggal_filter == 'H+3'){
            // Get today's date and the date 3 days from now
            $tgl_hari_ini = Carbon::today()->toDateString();
            $tgl_3 = Carbon::today()->addDays(2)->toDateString();

            // Create the query using Laravel's query builder
            $query_rapat = DB::table('dashboard_web_jadwal_rapat')
                ->where('tanggal_mulai', '>=', $tgl_hari_ini)
                ->where('tanggal_mulai', '<=', $tgl_3)
                ->where('akun','tania')
                ->orderBy('tanggal_mulai', 'asc')
                ->orderBy('pukul_mulai', 'asc')
                ->get();
        }elseif(isset($request->filter)){
            // Validate and sanitize the input
            $tanggal = htmlentities($request->input('filter'));

            // Execute the query using Laravel's query builder
            $query_rapat = DB::table('dashboard_web_jadwal_rapat')
                ->where('tanggal_mulai', '=', $tanggal)
                ->where('akun','tania')
                ->orderBy('tanggal_mulai', 'asc')
                ->orderBy('pukul_mulai', 'asc')
                ->get();
        }else{
            $tgl_hari_ini = Carbon::today()->toDateString();
            $tgl_3 = Carbon::today()->addDays(2)->toDateString();

            $query_rapat = DB::table('dashboard_web_jadwal_rapat')
                ->where('tanggal_mulai', '>=', $tgl_hari_ini)
                ->where('tanggal_mulai', '<=', $tgl_3)
                ->where('akun','tania')
                ->orderBy('tanggal_mulai', 'asc')
                ->orderBy('pukul_mulai', 'asc')
                ->get();
        }

        return view('dashboard_bkpsdm.jadwal_rapat.index',['query_rapat' => $query_rapat]);
    }
    public function dokumen_perencanaan()
    {
        $query_dokumen = DB::table('dok_perencanaan')
                                ->get();
        return view('dashboard_bkpsdm.dokumen_perencanaan.index',['query_dokumen' => $query_dokumen]);
    }
    public function dokumen_perencanaan_detail($kategori, $tahun = null)
{
    $list_tahun = DB::table('dok_perencanaan')
                    ->select('tahun')
                    ->where('kategori', $kategori)
                    ->distinct()
                    ->orderBy('tahun', 'desc')
                    ->get();

    // Redirect to first available year if not set
    if (!$tahun && $list_tahun->isNotEmpty()) {
        return redirect()->route('dokumen_perencanaan_detail', [
            'kategori' => $kategori,
            'tahun' => $list_tahun[0]->tahun
        ]);
    }

    $dokumen_master = DB::table('dok_perencanaan_master')
                        ->where('kategori', $kategori)
                        ->get();

    $tahun_range = [
        $tahun,
        $tahun - 1,
        $tahun - 2,
        $tahun - 3,
        $tahun - 4,
        $tahun - 5,
    ];

    $dokumen5thn = DB::table('dok_perencanaan')
        ->select('tahun', 'jenis_dokumen')
        ->distinct()
        ->whereIn('jenis_dokumen', ['RPJMD', 'Rencana Strategis'])
        ->whereIn('tahun', $tahun_range)
        ->get();

    foreach ($dokumen_master as &$value) {
        $jenis_dok = DB::table('dok_perencanaan')
            ->where('jenis_dokumen', $value->jenis_dokumen)
            ->where('tahun', $tahun)
            ->whereNotIn('jenis_dokumen', ['Rencana Strategis', 'RPJMD', 'BPK'])
            ->get();

        $value->jenis = $jenis_dok;
    }

    // Gabungkan dokumen master dengan dokumen 5 tahun strategis
    $dokumen = $dokumen_master->merge($dokumen5thn);

    return view('dashboard_bkpsdm.dokumen_perencanaan.detail', compact('kategori', 'tahun', 'list_tahun', 'dokumen'));
}


    // public function dokumen_perencanaan_detail_tahun($kategori,$tahun)
    // {
    //     $dokumen = DB::table('dok_perencanaan_master')
    //                 ->where('kategori', $kategori)
    //                 ->get();

    //     foreach ($dokumen as &$value) {
    //         $jenis_dok = DB::table('dok_perencanaan')
    //                             ->where('jenis_dokumen',$value->jenis_dokumen)
    //                             ->where('tahun',$tahun)
    //                             ->get();
    //         $value->jenis = $jenis_dok; // use -> instead of []
    //     }
    //     return view('dashboard_bkpsdm.dokumen_perencanaan.kategori_tahun',compact('kategori','tahun','dokumen'));
    // }
    public function dokumen_perencanaan_baru()
    {
        $query_dokumen = DB::table('dok_perencanaan')
                                ->get();
        return view('dashboard_bkpsdm.dokumen_perencanaan.index_baru',['query_dokumen' => $query_dokumen]);
    }
    public function dokumen_perencanaan_tahun($tahun)
    {
        $dokumen = DB::table('dok_perencanaan')
            ->select('tahun','jenis_dokumen')
            ->distinct()
            ->where('tahun', $tahun)
            ->where('jenis_dokumen','!=','Rencana Strategis')
            ->where('jenis_dokumen','!=','RPJMD')
            ->where('jenis_dokumen','!=','BPK')
            ->get();

        $tahun_1 = $tahun - 1;
        $tahun_2 = $tahun - 2;
        $tahun_3 = $tahun - 3;
        $tahun_4 = $tahun - 4;
        $tahun_5 = $tahun - 5;
        $dokumen5thn = DB::table('dok_perencanaan')
            ->select('tahun','jenis_dokumen')
            ->distinct()
            ->whereIn('jenis_dokumen', ['RPJMD', 'Rencana Strategis'])
            ->where(function($query) use ($tahun, $tahun_1, $tahun_2, $tahun_3, $tahun_4, $tahun_5) {
                $query->where('tahun', $tahun)
                    ->orwhere('tahun', $tahun_1)
                    ->orWhere('tahun', $tahun_2)
                    ->orWhere('tahun', $tahun_3)
                    ->orWhere('tahun', $tahun_4)
                    ->orWhere('tahun', $tahun_5);
            })
            ->get();

        $dokumen = $dokumen->merge($dokumen5thn);


        // Initialize $content as an empty array
        $content = [];

        // Loop through each distinct 'dokumen' item
        foreach ($dokumen as $item) {
            // Query to get documents of the specific 'jenis_dokumen' and 'tahun'
            $dokumen_content = DB::table('dok_perencanaan')
                ->where('jenis_dokumen', $item->jenis_dokumen)
                ->where('tahun', $item->tahun)
                ->get();
            
            // Merge the retrieved documents into the $content array
            $content = array_merge($content, $dokumen_content->toArray());
        }

        // Now, pass $content and $dokumen to the view
        return view('dashboard_bkpsdm.dokumen_perencanaan.per_tahun', compact('content', 'dokumen', 'tahun'));
    }

    public function dokumen_bpk($tahun)
    {
        // Get distinct sub_dokumen and tahun where jenis_dokumen is 'BPK'
        $dokumen = DB::table('dok_perencanaan')
            ->select('sub_dokumen', 'tahun')
            ->distinct()
            ->where('tahun', $tahun)
            ->where('jenis_dokumen', 'BPK')
            ->get();

        // Initialize $dokumen_content as an empty array
        $content = [];

        // Loop through each distinct 'dokumen' item
        foreach ($dokumen as $item) {
            // Query to get documents of the specific 'sub_dokumen' and 'tahun'
            $documents = DB::table('dok_perencanaan')
                ->where('sub_dokumen', $item->sub_dokumen)
                ->where('tahun', $item->tahun)
                ->get();

                foreach ($documents as $value) {
                    $content[] = $value;
                }
        }

        // Pass the data to the view
        return view('dashboard_bkpsdm.bpk.per_tahun', compact('tahun','dokumen', 'content'));
    }

    public function realisasi($tahun)
    {
        $realisasi = DB::table('info_apbd_anggaran')
                            ->where('tahun',$tahun)
                            ->orderBy('bulan','asc')
                            ->get();

        return view('dashboard_bkpsdm.realisasi.per_tahun',compact('tahun','realisasi'));
    }
    public function index_realisasi()
    {
        $realisasi = DB::table('info_apbd_anggaran')
                            ->orderBy('tahun','asc')
                            ->orderBy('bulan','asc')
                            ->get();

        return view('dashboard_bkpsdm.realisasi.index',compact('realisasi'));
    }


}
