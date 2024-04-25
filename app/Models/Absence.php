<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Absence
 *
 * @property string reason
 * @property string status
 * @property string from_date
 * @property string to_date
 * @property string student_id
 * @property string updated_by
 * @property User student
 * @property Teacher teacher
 *
 * @package App\Models
 */

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
        return $this->BelongsTo(Admin::class, 'updated_by');
    }
}
