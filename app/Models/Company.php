<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Company extends Authenticatable
{
    use HasFactory,Notifiable;
    
    protected $table = 'companies';
    protected $guard = 'company';

    protected $fillable = [
        'c_name', 'c_email', 'c_password', 'c_industry', 'c_size', 
        'c_established_year', 'c_type', 'c_city', 'c_country', 'c_postal_code', 'c_website', 'c_address'
    ];

    // In App\Models\Company.php
    public function company_details()
    {
        return $this->hasOne(CompanyDetail::class, 'company_id', 'id');
    }

    public function companyRatings()
    {
        return $this->hasMany(CompanyRatings::class, 'company_id');
    }

    protected $hidden = [
        'c_password',
    ];

    public function getAuthPassword()
    {
        return $this->c_password;
    }
}
