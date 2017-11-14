<?php
namespace app\modules\blog\models;

use yii\db\ActiveRecord;

class Article extends ActiveRecord {


    /**
     * Returns the table name
     * @return string
     */
    public static function tableName()
    {
        return 'article';
    }

    /**Rules applicable for the article model
     * @return array
     */
    public function rules()
    {
        return [
            [['category_id', 'status_id', 'title', 'description', 'created_at', 'updated_at'],'safe'],
            [['category_id', 'status_id'],'integer'],
            [['title', 'description'], 'required'],
            [['created_at'], 'default','value'=> date('Y-m-d H:i:s')],
            [['updated_at'], 'default', 'value' => '0000-00-00 00:00:00'],
        ];
    }

    /**
     * Shows relationship between the article and category model
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['category_id' => 'id']);
    }


    /**Shows the relationship between the article and status class
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['status_id' => 'id']);
    }
}