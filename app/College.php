<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class College extends Model
{
    // Specify the table name if it's different from the model's plural lowercase name
    protected $table = 'colleges';

    // Define the relationship between College and Course models
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}