<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function skill() {
        return $this->belongsTo(Skill::class, 'skill_id', 'id');
    }
}
