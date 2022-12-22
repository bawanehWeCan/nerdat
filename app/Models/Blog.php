<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['title', 'description', 'image'];

    /**
     * The attributes that should be cast.
     *
     * @var string[]
     */
    protected $casts = ['title' => 'string', 'description' => 'string', 'image' => 'string', 'created_at' => 'datetime:d/m/Y H:i', 'updated_at' => 'datetime:d/m/Y H:i'];

    // public function setImageAttribute($value){
    //     if ($value){
    //         $file = $value;
    //         $extension = $file->getClientOriginalExtension(); // getting image extension
    //         $filename =time().mt_rand(1000,9999).'.'.$extension;
    //         $file->move(public_path('img/'), $filename);
    //         $this->attributes['image'] =  'img/'.$filename;
    //     }
    // }

}
