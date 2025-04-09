<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'job_types';

    protected $fillable = ['type_name']; // Optional for mass assignment
}
