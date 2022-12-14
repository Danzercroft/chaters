<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $attributes = [
        'name' => null,
    ];

    protected $fillable = [
        'name'
    ];

    protected $hidden = ['pivot'];

    public function users() {
        return $this->belongsToMany('App\User', 'user_channel')->withTimestamps()->select('name','id');
    }

    public static function findOrNew($sender, $receiver) {
        $channelIsFound = Channel::where('type', 'dm')->whereHas('users', function($q) use ($sender) {
            $q->where('user_id',$sender  );
       })->whereHas('users', function($q) use ($receiver) {
           $q->where('user_id',$receiver);
       })->get();
    }
}
