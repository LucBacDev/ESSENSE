<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = ['name', 'status', 'parent_id'];
    use HasFactory;

    // used to search
    public function scopeSearch($query)
    {
        // $query = $query->where('type','like','%'.request()->keyword.'%');
        return $query;
    }
}