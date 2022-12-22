<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['question', 'description', 'subject_id', 'lesson_id', 'unit_id'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['question' => 'string', 'description' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];



	public function subject()
	{
		return $this->belongsTo(\App\Models\Subject::class);
	}
	public function lesson()
	{
		return $this->belongsTo(\App\Models\Lesson::class);
	}
	public function unit()
	{
		return $this->belongsTo(\App\Models\Unit::class);
	}



    public function answers()
	{
		return $this->hasMany(\App\Models\Answer::class);
	}
}
