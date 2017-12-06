<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 11/23/17
 * Time: 3:17 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class FoodClass  extends ActiveRecord
{

    public static function tableName()
    {
        return 'foodclass';
    }

    public function rules()
    {
        return [
            [['name', 'calorie', 'created_at','updated_at'], 'safe'],
            [['name', 'calorie'], 'required'],
            [['created_at'], 'default','value'=> date('Y-m-d H:i:s')],
            [['updated_at'], 'default', 'value' => '0000-00-00 00:00:00'],
        ];
    }



}