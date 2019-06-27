<?php

namespace app\index\model;

use think\Model;

class User extends Model
{
    public function shuxue()
    {
    	return $this->hasOne('Shuxue','user_id');
    }

    public function yuwen()
    {
    	return $this->hasmany('Yuwen','user_id');
    }
}
