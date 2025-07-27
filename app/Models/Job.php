<?php

namespace App\Models;

use App\Models\Employer;
use App\Models\JobApplication;
use Illuminate\Contracts\Auth\Authenticatable;
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

    protected $fillable = [
        'title','location','salary','description','experience','category'
    ];




    public function scopeFilter(Builder | QueryBuilder $query, array $filters)
    {
        return $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('employer', function ($q) use ($search) {
                        $q->where('company_name', 'like', '%' . $search . '%');
                    });
            });
        })
            ->when($filters['min_salary'] ?? null, function ($query, $minSalary) {
                $query->where('salary', '>=', $minSalary);
            })
            ->when($filters['max_salary'] ?? null, function ($query, $maxSalary) {
                $query->where('salary', '<=', $maxSalary);
            })
            ->when($filters['experience'] ?? null, function ($query, $experience) {
                $query->where('experience', $experience);
            })
            ->when($filters['category'] ?? null, function ($query, $category) {
                $query->where('category', $category);
            });
    }

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }
    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
    public function HasUserApplied(Authenticatable|User|int $user)
    {
        return $this->where('id', $this->id)
            ->whereHas(
                'jobApplications',
                fn($q) => $q
                    ->where('user_id', '=', $user->id ?? $user)
            )
            ->exists();
    }

}
