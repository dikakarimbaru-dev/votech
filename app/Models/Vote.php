<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['candidate_id'];

    // Relasi balik: Satu suara ini milik siapa?
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function votes()
    {
    return $this->hasMany(Vote::class);
    }
}