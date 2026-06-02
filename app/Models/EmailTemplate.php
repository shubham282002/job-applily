<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'user_id',
        'master_subject_id',
        'master_description_id',
        'name',
        'subject',
        'html_content'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function masterSubject()
    {
        return $this->belongsTo(MasterSubject::class, 'master_subject_id');
    }

    public function masterDescription()
    {
        return $this->belongsTo(MasterDescription::class, 'master_description_id');
    }
}
