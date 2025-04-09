<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'job_category_id','job_type_id','user_id','company_id', 'vacancy', 'salary', 'location', 'description', 'responsibility', 'qualifications', 'benefits', 'experience','required_skills', 'keywords', 'company_name', 'company_location', 'company_industry', 'company_website'];

    public function jobType(){
        return $this->belongsTo(JobType::class);
    }

    public function category(){
        return $this->belongsTo(Category::class, 'job_category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applicants_count(){
        return $this->hasMany(JobApplication::class, 'job_id');
   }

   public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

}
