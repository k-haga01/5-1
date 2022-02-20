<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $guarded = array('id');

    // 以下を追記
    public static $rules = array(
        'body' => 'required',
    );

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
