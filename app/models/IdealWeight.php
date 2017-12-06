<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 11/28/17
 * Time: 5:44 PM
 */

namespace app\models;

use yii\db\ActiveRecord;

class IdealWeight extends ActiveRecord {

    public static function tableName() {
        return 'idealWeight';
    }

    public function rules(){
        return [
            ['sex', 'required'],
            [['name', 'value', 'sex'], 'safe'],
        ];
    }

    public function calcIBW($height, $sex){

    }

    public function getUser(){
        return $this->hasMany(User::className(), ['user_id' => 'id']);
    }

}