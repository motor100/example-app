<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Redirect extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_id',
        'ip'
    ];

    // Один ко многим
    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
