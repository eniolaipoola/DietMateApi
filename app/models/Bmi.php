<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 11/28/17
 * Time: 5:43 PM
 */

namespace app\models;


use yii\db\ActiveRecord;

class Bmi extends ActiveRecord {

    public static function tableName()
    {
        return 'bmi';
    }

    public function rules()
    {
        return [
            [['class','upper_bound', 'lower_bound'],'required'],
            ['class', 'string'],
            ['range', 'string'],
            [['created_at'], 'default','value'=> date('Y-m-d H:i:s')],
            [['updated_at'], 'default', 'value' => '0000-00-00 00:00:00'],
        ];
    }

    public function range($lower, $upper){
        $range = $lower."-".$upper;
        return $range;
    }
}