<?php

namespace App\Models;

use App\Scopes\ReviewStatusScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected const STATUS = [
      "new" => 0,
      "accepted" => 1,
      "rejected" => 2,
    ];

    protected $fillable = [
        "name", "email", "text", "status", "edited_at", "photo"
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ReviewStatusScope);
    }
}
