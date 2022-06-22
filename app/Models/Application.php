<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Application extends Model
{
    protected $fillable = ['first_name', 'last_name', 'attachments'];

    public function attachments(): HasMany
    {
        return $this->hasMany(ApplicationAttachment::class);
    }
}
