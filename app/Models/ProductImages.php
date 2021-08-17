<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class ProductImages extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'products_id',
        'url'
    ];

    public function getUrlAttributes($url) {
        return config('app.url') . Storage::url($url);
    }
}
