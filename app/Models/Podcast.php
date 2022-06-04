<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'podcast_id',
        'title',
        'description',
        'podcast_url',
        'poster_url',
        'podcast_category',
        'podcast_subcategory',
        'uploader_id',
        'uploader_name',
        
    ];
}