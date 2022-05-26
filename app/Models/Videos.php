<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id',
        'title',
        'description',
        'video_url',
        'poster_url',
        'video_category',
        'video_subcategory',
        'video_tags',
        'uploader_id',
        'uploader_name',
        'views',
        'likes',
        'dislikes',
        'comments',
    ];
}