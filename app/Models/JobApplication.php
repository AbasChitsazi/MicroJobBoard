<?php

namespace App\Models;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationFactory> */
    use HasFactory;
    protected $fillable = [
        'expected_salary',
        'user_id',
        'job_id',
        'cv_path',
        'is_approved'
    ];

    public function job(): BelongsTo
    {
        return $this->belongsTo(Job::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function scopeFilter($query, $search)
    {
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {

                $q->whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where(function ($uq) use ($search) {
                        $uq->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
                })

                    ->orWhereHas('job', function ($jobQuery) use ($search) {
                        $jobQuery->where('title', 'like', "%{$search}%")
                            ->orWhereHas('employer', function ($employerQuery) use ($search) {
                                $employerQuery->where('company_name', 'like', "%{$search}%");
                            });
                    });
            });
        }
    }
}
