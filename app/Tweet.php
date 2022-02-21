<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tweet extends Model
{
    use SoftDeletes;
    protected $guarded = array('id');
    protected $dates = ['deleted_at'];
    // 以下を追記
    public static $rules = array(
        'body' => 'required',
    );

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
