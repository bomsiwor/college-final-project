<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $fillable = [
        'title',
        'category',
        'topic',
        'description',
        'file',
        'status'
    ];

    public function scopeCategory(Builder $query, string $category, string $status = 'published')
    {
        return $query->where('category', '=', $category)->where('status', $status);
    }

    public function scopeFilter(Builder $query, string $filter)
    {
        return $query->where('title', 'like', '%' . $filter . '%')
            ->orWhere('topic', 'like', '%' . $filter . '%');
    }
}
