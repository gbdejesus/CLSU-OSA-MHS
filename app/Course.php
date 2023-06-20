<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Specify the table name if it's different from the model's plural lowercase name
    protected $table = 'courses';

    // Define the relationship between Course and College models
    public function college()
    {
        return $this->belongsTo(College::class);
    }
}