<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Banners extends Model
{
    use HasFactory, Sortable;
    protected $table = 'banners';
    public $sortable = [
        'id', 'title'
    ];
    protected $fillable = [
        'title', 'image', 'additional_image', 'status'
    ];
}
