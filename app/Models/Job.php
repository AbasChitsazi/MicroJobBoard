<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    public static array $experience = ['entry', 'intermediate', 'senior'];
    public static array $jobcategory = ['IT', 'Finance', 'Marketing', 'CTO', 'CEO', 'Sales', 'UI/UX', 'Developer'];

    protected $guarded = [];
}
