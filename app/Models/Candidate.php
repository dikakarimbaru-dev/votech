<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function votes()
{
    return $this->hasMany(Vote::class);
}
}
