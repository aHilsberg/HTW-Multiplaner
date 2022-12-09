<?php

namespace App\Models;

use App\Enums\ModuleContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Module extends Model {
    use HasFactory;

    protected $keyType = 'string';

    /**
     * the attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'level',
        'semester_count',
        'modulux_url',
        'opal_url',
    ];


    public function appointments(): MorphMany {
        return $this->morphMany(Appointment::class, 'appointable');
    }

    public function appointmentStudyGroups() {
        return $this->hasManyThrough(AppointmentStudyGroup::class, Appointment::class, 'appointable_id', 'appointment_id');
    }

    public function textContents(): HasMany {
        return $this->hasMany(TextContent::class);
    }

    public function name() {
        return $this->textContents()->where('reference', ModuleContent::Name);
    }

    public function languages() {
        return $this->textContents()->where('reference', ModuleContent::Languages);
    }

    public function supervisors() {
        return $this->textContents()->where('reference', ModuleContent::Supervisors);
    }

    public function lecturers() {
        return $this->textContents()->where('reference', ModuleContent::Lecturers);
    }

    public function events() {
        return $this->textContents()->where('reference', ModuleContent::Events);
    }

    public function workload() {
        return $this->textContents()->where('reference', ModuleContent::Workload);
    }

    public function credits() {
        return $this->textContents()->where('reference', ModuleContent::Credits);
    }

    public function preExaminationWork() {
        return $this->textContents()->where('reference', ModuleContent::PreExaminationWork);
    }

    public function examinationWork() {
        return $this->textContents()->where('reference', ModuleContent::ExaminationWork);
    }


    public function content() {
        return $this->textContents()->where('reference', ModuleContent::Content);
    }

    public function skills() {
        return $this->textContents()->where('reference', ModuleContent::Skills);
    }

    public function requirements() {
        return $this->textContents()->where('reference', ModuleContent::Requirements);
    }

    public function requirementsOptional() {
        return $this->textContents()->where('reference', ModuleContent::OptionalRequirements);
    }

    //-----------------------------------------------------------------------------------------------------

    public function createTextContents(array $textContents, ModuleContent $contentType) {
//        error_log('doing'. $contentType->name);
//        error_log(json_encode($textContents));
        if(empty($textContents)) return;
        foreach ($textContents as $key => $textContent) {
            $textContents[$key]['reference'] = $contentType->value;
        }
        $this->textContents()->createMany($textContents);
    }
}
