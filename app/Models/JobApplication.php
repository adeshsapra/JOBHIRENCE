<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_application';

    protected $fillable = [
        'job_id',
        'user_id',
        'employer_id',
        'applied_date',
        'poster_type',
        'company_id',
        'status'
    ];

    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }

    protected $casts = [
        'applied_date' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
