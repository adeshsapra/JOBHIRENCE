<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyRatings extends Model
{
    protected $fillable = ['user_id', 'company_id', 'rating', 'feedback'];
    protected $table = 'company_ratings';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}