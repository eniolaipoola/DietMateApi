<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 11/9/17
 * Time: 10:09 PM
 */

namespace app\modules\blog\models;

use yii\db\ActiveRecord;

class Status extends ActiveRecord
{

    /**Returns associated table
     * @return string
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * Returns the rules associated with status table
     * @return array
     */
    public function rules()
    {
        return [
            ['name', 'safe'],
            [['name'], 'required'],
            [['created_at'], 'default','value'=> date('Y-m-d H:i:s')],
            [['updated_at'], 'default', 'value' => '0000-00-00 00:00:00']
        ];
    }

    /** Returns a customized name of table columns
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Status',
            'created_at' => 'Date Created',
            'updated_at' => 'Date Updated'
        ];
    }
}