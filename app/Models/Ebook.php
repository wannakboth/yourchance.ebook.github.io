<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'ebooks';
    protected $fillable = [
        'id',
        'author_id',
        'category_id',
        'ebook_kh',
        'ebook_eng',
        'price',
        'count_view',
        'desc_kh',
        'desc_eng',
        'images',
        'count_image',
        'orderby',
        'status',
    ];

    public function author(){
        return $this->belongsTo(Author::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function price(){
        return $this->hasMany(Price::class);
    }

    public function content(){
        return $this->hasMany(Content::class);
    }
}
