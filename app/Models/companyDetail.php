<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $table = 'company_details'; 

    protected $fillable = [
        'company_id',
        'profile_img',
        'cover_img',
        'market_type',
        'about',
        'headquarters',
        'contact_email',
        'phone',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
    ];

    // In App\Models\CompanyDetail.php
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
