<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absence extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function student(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->BelongsTo(Admin::class);
    }
}
