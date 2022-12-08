<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class BlogTags extends Model
{
    use HasFactory, Sortable;
    protected $table = 'blog-tags';
    public $sortable = [
        'tag_name', 'slug'
    ];
    protected $fillable = [
        'tag_name', 'slug'
    ];
}
