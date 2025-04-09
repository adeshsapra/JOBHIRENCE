<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSaved extends Model
{
    protected $table = 'job_saved';

    protected $fillable = ['job_id','user_id']; 

    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }
}
