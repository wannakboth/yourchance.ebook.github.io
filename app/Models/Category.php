<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'catagories';
    protected $fillable = [
        'id',
        'category_kh',
        'category_eng',
        'desc_kh',
        'desc_eng',
        'orderby',
        'status',
    ];

    public function ebook(){
        return $this->hasMany(Ebook::class);
    }
}
