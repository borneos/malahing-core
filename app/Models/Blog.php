<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Blog extends Model
{
    use HasFactory, Sortable;

    protected $table = 'blogs';
    public $sortable = [
        'id', 'title', 'author'
    ];
    protected $fillable = [
        'title', 'short_description', 'description', 'author', 'status', 'image', 'additional_image'
    ];
}
