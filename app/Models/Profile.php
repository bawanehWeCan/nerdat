<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['lname', 'phone', 'gender', 'classroom_id', 'school_grade_id', 'user_id'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['lname' => 'string', 'phone' => 'string', 'gender' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    
	
	public function classroom()
	{
		return $this->belongsTo(\App\Models\Classroom::class);
	}	
	public function school_grade()
	{
		return $this->belongsTo(\App\Models\SchoolGrade::class);
	}	
	public function user()
	{
		return $this->belongsTo(\App\Models\User::class);
	}
}
