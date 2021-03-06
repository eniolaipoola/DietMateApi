<?php

namespace app\modules\blog\models;


use yii\db\ActiveRecord;

class Category extends  ActiveRecord
{

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * Returns the rules associated with category table
     * @return array
     */
    public function rules()
    {
        return [
            ['name', 'safe'],
            [['name'], 'required'],
           // [['created_at', 'updated_at'], 'NOT NULL','TIMESTAMP'],
        ];
    }

    /** Returns a customized name of table columns
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Category'
        ];
    }

    /**Shows relationship between this model and the article model
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasMany(Article::className(), ['id' => 'status_id']);
    }
}