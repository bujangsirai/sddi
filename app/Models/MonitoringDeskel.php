<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringDeskel extends Model
{

    protected $table = 'monitoring_deskel';


    protected $fillable = [
        'master_deskel_id',
        'progress_persen',
        'detail_progress',
        'catatan'
    ];

    protected $casts = [
        'detail_progress' => 'array',
    ];

    /**
     * Relasi ke MasterDeskel
     */
    public function masterDeskel()
    {
        return $this->belongsTo(MasterDeskel::class);
    }

    /**
     * Hitung progress otomatis dari detail
     */
    public static function hitungProgress($detail)
    {
        if (empty($detail['kegiatan'])) return 0;

        $total = 0;
        foreach ($detail['kegiatan'] as $kegiatan) {
            $total += $kegiatan['progress'];
        }

        return $total / count($detail['kegiatan']);
    }
}
