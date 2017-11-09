<?php

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord{

    public static function tableName(){
        return 'users';
    }

    public function rules() {
        return [
            [['firstname, lastname, email, username, password'], 'safe']
        ];
    }

    public function scenarios()
    {
        return parent::scenarios();
    }

    public function checkRole(){

    }
}
