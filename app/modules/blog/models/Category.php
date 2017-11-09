<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 11/2/17
 * Time: 1:18 PM
 */

namespace app\modules\blog\models;


use yii\db\ActiveRecord;

class Category extends  ActiveRecord {
    public static function tableName()
    {
        return 'category';
    }

}