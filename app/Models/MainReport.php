<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class MainReport
 *
 * @property string chapters
 * @property string pages
 * @property string new
 * @property string previous
 * @property string old
 * @property integer current_from
 * @property integer current_to
 * @property integer lesson
 * @property boolean listen
 * @property boolean repeat
 * @property integer amount_of_pages
 * @property integer repeated_amount
 * @property integer stage
 * @property integer level
 * @property integer surah
 * @property string type
 * @property integer mistakes
 * @property integer hesitations
 * @property integer warnings
 * @property integer total_score
 * @property integer max_score
 * @property string time_taken
 * @property string reported_at
 * @property string day
 *
 * @property User student
 * @property Teacher teacher
 *
 */

class MainReport extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['formatted_pages'];

    public function scopeStudentReportsPages($query, $studentId)
    {
        return $query->where('student_id', $studentId)
            ->where('type', 'daily')
            ->whereNotNull('pages');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function getFormattedPagesAttribute(){
        return json_decode($this->pages, true);
    }
}
