<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Link extends Model
{
    protected $fillable = [
        'user_id',
        'long_link',
        'short_link'
    ];

    // Один ко многим
    public function redirects()
    {
        return $this->hasMany(Redirect::class);
    }
    
    protected static function booted()
    {
        parent::booted();

        static::addGlobalScope(new ActiveScope());
    }
}
