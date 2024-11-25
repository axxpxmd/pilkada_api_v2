<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of welcome
 *
 * @author Asip Hamdi
 * Github : axxpxmd
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

// Models
use App\Models\Kelurahan;
use App\Models\SuaraGubernur;

class TpsSudahController extends Controller
{
    public function getTpsSudahByKota()
    {
        $provinsi_id = 36;

        $totalTps = Kelurahan::select('tmkota.id', 'tmkota.n_kota', DB::raw('SUM(jumlah_tps) as jumlah_tps'))
            ->joinwilayah($provinsi_id)
            ->groupBy('tmkota.id')
            ->orderBy('tmkota.id', 'ASC')
            ->get();

        $TotalTpsMasuk = SuaraGubernur::select('tmkota.id', 'tmkota.n_kota', DB::raw('COUNT(tps) as jumlah_tps'))
            ->rightJoin('tmkota', 'tmkota.id', '=', 'id_kota')
            ->where('tmkota.provinsi_id', $provinsi_id)
            ->groupBy('tmkota.id')
            ->orderBy('tmkota.id', 'ASC')
            ->get();

        $data = [];
        foreach ($totalTps as $key => $i) {
            $total_tps = $i->jumlah_tps;
            $total_tps_masuk =  $TotalTpsMasuk[$key]->jumlah_tps / 2;
            $total_tps_belum_masuk = $total_tps - $total_tps_masuk;

            $data[$key] = [
                'id' => $i->id,
                'n_kota' => $i->n_kota,
                'total_tps' => $total_tps,
                'total_tps_masuk' => $total_tps_masuk,
                'total_tps_belum_masuk' => $total_tps_belum_masuk,
                'percent' => round($total_tps_masuk / $total_tps * 100, 2) . '%'
            ];
        }

        return response()->json([
            'statusCode'  => 200,
            'total_data' => count($TotalTpsMasuk),
            'data' => $data
        ], 200);
    }

    public function getTpsSudahByKecamatan($id_kota)
    {
        $provinsi_id = 36;

        $totalTps = Kelurahan::select('tmkecamatan.id', 'tmkecamatan.n_kecamatan', DB::raw('SUM(jumlah_tps) as jumlah_tps'))
            ->joinwilayah($provinsi_id)
            ->where('tmkota.id', $id_kota)
            ->groupBy('tmkecamatan.id')
            ->orderBy('tmkecamatan.id', 'ASC')
            ->get();

        $TotalTpsMasuk = SuaraGubernur::select('tmkecamatan.id', 'tmkecamatan.n_kecamatan', DB::raw('COUNT(tps) as jumlah_tps'))
            ->rightJoin('tmkecamatan', 'tmkecamatan.id', '=', 'id_kec')
            ->where('tmkecamatan.kota_id', $id_kota)
            ->groupBy('tmkecamatan.id')
            ->orderBy('tmkecamatan.id', 'ASC')
            ->get();

        $data = [];
        foreach ($totalTps as $key => $i) {
            $total_tps = $i->jumlah_tps;
            $total_tps_masuk =  $TotalTpsMasuk[$key]->jumlah_tps / 2;
            $total_tps_belum_masuk = $total_tps - $total_tps_masuk;

            $data[$key] = [
                'id' => $i->id,
                'n_kecamatan' => $i->n_kecamatan,
                'total_tps' => $total_tps,
                'total_tps_masuk' => $total_tps_masuk,
                'total_tps_belum_masuk' => $total_tps_belum_masuk,
                'percent' => round($total_tps_masuk / $total_tps * 100, 2) . '%'
            ];
        }

        return response()->json([
            'statusCode'  => 200,
            'total_data' => count($TotalTpsMasuk),
            'data' => $data
        ], 200);
    }

    public function getTpsSudahByKelurahan($id_kecamatan)
    {
        $provinsi_id = 36;

        $totalTps = Kelurahan::select('tmkelurahan.id', 'tmkelurahan.n_kelurahan', DB::raw('SUM(jumlah_tps) as jumlah_tps'))
            ->joinwilayah($provinsi_id)
            ->where('tmkecamatan.id', $id_kecamatan)
            ->groupBy('tmkelurahan.id')
            ->orderBy('tmkelurahan.id', 'ASC')
            ->get();

        $TotalTpsMasuk = SuaraGubernur::select('tmkelurahan.id', 'tmkelurahan.n_kelurahan', DB::raw('COUNT(tps) as jumlah_tps'))
            ->rightJoin('tmkelurahan', 'tmkelurahan.id', '=', 'id_kel')
            ->where('tmkelurahan.kecamatan_id', $id_kecamatan)
            ->groupBy('tmkelurahan.id')
            ->orderBy('tmkelurahan.id', 'ASC')
            ->get();

        $data = [];
        foreach ($totalTps as $key => $i) {
            $total_tps = $i->jumlah_tps;
            $total_tps_masuk =  $TotalTpsMasuk[$key]->jumlah_tps / 2;
            $total_tps_belum_masuk = $total_tps - $total_tps_masuk;

            $data[$key] = [
                'id' => $i->id,
                'n_kelurahan' => $i->n_kelurahan,
                'total_tps' => $total_tps,
                'total_tps_masuk' => $total_tps_masuk,
                'total_tps_belum_masuk' => $total_tps_belum_masuk,
                'percent' => round($total_tps_masuk / $total_tps * 100, 2) . '%'
            ];
        }

        return response()->json([
            'statusCode'  => 200,
            'total_data' => count($TotalTpsMasuk),
            'data' => $data
        ], 200);
    }
}
