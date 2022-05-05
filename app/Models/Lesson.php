<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'lessons';
    protected $fillable = [
        'id',
        'content_id',
        'header_kh',
        'header_eng',
        'sub_header_kh',
        'sub_header_eng',
        'images',
        'orderby',
        'status',
    ];

    public function content(){
        return $this->belongsTo(Content::class);
    }
}
