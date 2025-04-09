<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasAttributes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['fullName', 'email', 'password', 'google_id', 'mobile_number', 'designation', 'bio'];


    // Define relationship with UserDetail
    public function details()
    {
        return $this->hasOne(userDetail::class, 'user_id');
    }

    public function feedbacks()
    {
        return $this->hasOne(Feedback::class, 'user_id');
    }

    public function applicants_count(){
        return $this->hasMany(JobApplication::class, 'job_id');
    }
    public function companyRatings()
    {
        return $this->hasMany(CompanyRatings::class, 'user_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
