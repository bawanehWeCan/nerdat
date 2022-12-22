<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['is_correct', 'question_id', 'answer_id', 'result_id', 'user_id'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['is_correct' => 'integer', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    
	
	public function question()
	{
		return $this->belongsTo(\App\Models\Question::class);
	}	
	public function answer()
	{
		return $this->belongsTo(\App\Models\Answer::class);
	}	
	public function result()
	{
		return $this->belongsTo(\App\Models\Result::class);
	}	
	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
