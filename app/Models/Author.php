<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'authors';
    protected $fillable = [
        'id',
        'author_kh',
        'author_eng',
        'desc_kh',
        'desc_eng',
        'orderby',
        'status',
    ];

    public function ebook(){
        return $this->hasMany(Ebook::class);
    }
}
