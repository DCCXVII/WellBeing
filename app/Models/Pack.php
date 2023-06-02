<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'niveau',
        'price',
        'coach_id',
        // 'classe_id',
        'discipline_id',
        'background_image',
        'views_number',
        'sells_number',
        'teaser',
        'courses_number',
        'status',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class, 'id_coach', 'id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }


    
}