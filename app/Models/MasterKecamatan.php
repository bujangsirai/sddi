<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterKecamatan extends Model
{
    protected $table = 'master_kecamatan';

    public function monitoring()
    {
        return $this->hasMany(MonitoringDeskel::class);
    }

    public function desaKelurahan()
    {
        return $this->hasMany(MasterDeskel::class, 'wilkerstat_kecamatan_id', 'wilkerstat_kecamatan_id');
    }
}
