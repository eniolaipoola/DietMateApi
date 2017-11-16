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
            ['name', 'required'],
            [['created_at'], 'default','value'=> date('Y-m-d H:i:s')],
            [['updated_at'], 'default', 'value' => '0000-00-00 00:00:00'],
        ];
    }

    public function getUser() {
       return $this->hasMany(User::className(), ['id' => 'role_id']);
    }

}