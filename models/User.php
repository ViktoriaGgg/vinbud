<?php

namespace app\models;
use mdm\admin\models\User as UserModel;

class User extends UserModel
{
    public function getExpert(){
        return $this->hasOne(Expert::className(), ['user_id'=>'id']);
    }

}
