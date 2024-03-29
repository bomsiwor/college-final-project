<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tool extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    protected $dates = ['updated_at', 'purchase_date'];

    protected $casts = [
        'tool_image' => 'array',
    ];

    protected $fillable = [
        'inventory_unique',
        'inventory_number',
        'name',
        'merk',
        'series',
        'description',
        'condition',
        'status',
        'used_status',
        'purchase_date',
        'price',
        'manual',
        'tool_image',
        'tool_image->image_0',
        'tool_image->image_1',
    ];


    // Scope
    public function scopeSummary(Builder $query)
    {
        return $query->select('name', 'merk', 'series', 'condition', 'status', 'inventory_unique')->orderBy('purchase_date', 'desc')->get();
    }

    public function scopeApiSummary(Builder $query)
    {
        return $query->select('id', 'name', 'merk', 'series', 'condition', 'status', 'inventory_number', 'tool_image')->orderBy('id');
    }

    public function scopeTopBorrowed(Builder $query)
    {
        return $query->select('id', 'name', 'inventory_number', 'condition')->withCount('borrow')->orderByDesc('borrow_count')->limit(5)->get();
    }

    public function scopeUpdateConditionBy(Builder $query, string $column, $value, array $data)
    {
        return $query->where($column, '=', $value)->update($data);
    }


    // Relation
    public function borrow()
    {
        return $this->hasMany(Borrow::class, 'inventory_id', 'inventory_unique');
    }

    public function logs()
    {
        return $this->hasMany(ToolLog::class, 'inventory_id', 'inventory_unique');
    }
}
