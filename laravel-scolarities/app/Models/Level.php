<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $fillable = ['code', 'libelle', 'scolarite', 'school_year_id'];

    public function schoolFees()
    {
        return $this->hasMany(SchoolFees::class);
    }
}
 