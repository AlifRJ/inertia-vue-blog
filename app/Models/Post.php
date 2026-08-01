<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

   use HasFactory, SoftDeletes, Sluggable;
//    protected $fillable = ["title", "excerpt", "body"];
   protected $guarded = ["id"];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
   public function user(): BelongsTo
    {
        
        return $this->belongsTo(User::class);
        
    }
   public function category(): BelongsTo
    {
        
        return $this->belongsTo(PostCategory::class);
        
    }
}
