<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 11/2/17
 * Time: 1:08 PM
 */

namespace app\modules\blog\models;


use yii\db\ActiveRecord;

class Article extends ActiveRecord {
    public static function tableName()
    {
        return 'article';
    }

    public function rules()
    {
        return [
            [['category_id', 'status_id', 'title', 'description', 'created_at', 'updated_at'],'safe'],
            [['category_id', 'status_id'],'integer'],
            [['title', 'description'], 'required'],
        ];
    }

    public function getCategory() {
        return $this->hasOne(Category::className(), ['category_id' => 'id']);
    }
}