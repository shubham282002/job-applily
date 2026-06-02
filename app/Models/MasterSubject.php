<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterSubject extends Model
{
    protected $table = 'master_subjects';

    protected $fillable = ['category', 'title', 'description'];

    public function emailTemplates()
    {
        return $this->hasMany(EmailTemplate::class, 'master_subject_id');
    }
}
