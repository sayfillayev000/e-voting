<?php

namespace App\Models;

use App\Observers\CandidateObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'picture', 'resume', 'election_number', 'total_voter'];

    public function voters()
    {
        return $this->hasMany(User::class);
    }
}
