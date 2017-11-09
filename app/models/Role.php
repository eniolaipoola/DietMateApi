<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 9/29/17
 * Time: 12:23 AM
 */

namespace app\models;

use yii\db\ActiveRecord;

class Role extends ActiveRecord
{
    public static function tableName()
    {
        return 'roles';
    }

    public function rules()
    {
        return [
            [['name', 'created_at','updated_at'], 'safe'],
        ];
    }

    public function getUser() {
       return $this->hasMany(Users::className(), ['role_id' => 'id']);
    }



}