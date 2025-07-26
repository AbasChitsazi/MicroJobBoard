<?php

namespace App\Models;

use App\Models\Employer;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    public static array $experience = ['entry', 'intermediate', 'senior'];
    public static array $jobcategory = ['IT', 'Finance', 'Marketing', 'CTO', 'CEO', 'Sales', 'UI/UX', 'Developer'];

    protected $guarded = [];




    public function scopeFilter(Builder | QueryBuilder $query, array $filters)
    {
        return $query->when($filters['search'] ?? null, function ($query,$search)  {
            $query->where(function ($q) use($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('employer',function($q) use($search){
                        $q->where('company_name','like', '%' . $search . '%');
                    });
            });
        })
            ->when($filters['min_salary'] ?? null, function ($query,$minSalary) {
                $query->where('salary', '>=', $minSalary);
            })
            ->when($filters['max_salary'] ?? null, function ($query,$maxSalary) {
                $query->where('salary', '<=', $maxSalary);
            })
            ->when($filters['experience'] ?? null, function ($query,$experience) {
                $query->where('experience', $experience);
            })
            ->when($filters['category'] ?? null, function ($query,$category) {
                $query->where('category', $category);
            });
    }

    public function employer() :BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }
    public function job_applications():HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
}
