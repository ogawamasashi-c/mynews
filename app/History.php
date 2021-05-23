<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'news_id' => 'required',
        'edited_at' => 'required',
    );
// 以下を追記
    // Newsモデルに関連付けを行う
    public function histories()
    {
        return $this->hasMany('App\History');

    }

}


