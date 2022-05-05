<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'contents';
    protected $fillable = [
        'id',
        'ebook_id',
        'content_kh',
        'content_eng',
        'count_minute',
        'is_read',
        'orderby',
        'status',
    ];

    public function ebook(){
        return $this->belongsTo(Ebook::class);
    }

    public function lesson(){
        return $this->hasMany(Lesson::class);
    }
}
