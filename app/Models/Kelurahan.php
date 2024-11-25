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

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'tmkelurahan';

    public static function scopeJoinWilayah($query, $provinsi_id)
    {
        return $query->join('tmkecamatan', 'tmkecamatan.id', '=', 'tmkelurahan.kecamatan_id')
            ->join('tmkota', 'tmkota.id', '=', 'tmkecamatan.kota_id')
            ->join('tmprovinsi', 'tmprovinsi.id', '=', 'tmkota.provinsi_id')
            ->where('tmprovinsi.id', $provinsi_id);
    }
}
