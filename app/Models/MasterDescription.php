<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterDescription extends Model
{
    protected $table = 'master_descriptions';

    protected $fillable = ['type', 'title', 'content'];

    public function emailTemplates()
    {
        return $this->hasMany(EmailTemplate::class, 'master_description_id');
    }
}
