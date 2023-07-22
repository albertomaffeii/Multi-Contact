<?php

namespace App\Models;

use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
     protected $fillable = ['countrycode', 'number', 'user_id'];

    public $timestamps = false;

    protected $guarded = [];
    
    public static $rules = [
        'country_code' => 'required',
        'number' => 'required|digits:9',
    ];
    
    public function getAvatarAttribute()
    {
        $avatar = Avatar::create($this->number)->toBase64();
        return 'data:image/png;base64,' . $avatar;
    }

    public function user(){
        return $this->belongsTo('App\Models\User');

    }

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }

}
