<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPoliticalParty extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function politicalParty() {
        return $this->belongsTo(PoliticalParty::class, 'political_party_id', 'id');
    }
}
