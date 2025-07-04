<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterDeskel extends Model
{
        protected $table = 'master_deskel';
        public function monitoring()
        {
                return $this->hasMany(MonitoringDeskel::class, 'master_deskel_id');
        }

        public function masterKecamatan()
        {
                return $this->belongsTo(MasterKecamatan::class, 'wilkerstat_kecamatan_id', 'wilkerstat_kecamatan_id');
        }
}
