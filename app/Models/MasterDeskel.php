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
}
