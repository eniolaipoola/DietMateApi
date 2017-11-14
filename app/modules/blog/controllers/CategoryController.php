<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 9/14/17
 * Time: 9:35 AM
 */

namespace app\modules\blog\controllers;

use Yii;
use app\modules\blog\models\Category;
use yii\rest\Controller;

class CategoryController extends Controller{
   //$response = new \app\components\APIResponse;
    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionIndex(){
        $data = Category::find()->all();
        return $data;
    }

    /**
     * @return Category|string
     */
    public function actionCreate(){
        $model = new Category();
        $model->attributes = Yii::$app->request->bodyParams;
        if(isset($model->attributes)){
            $model->save();
        } else {
            Yii::$app->response->badReqeust("Please fill in all required fields");
        }
        return $model;
    }

    /**
     * @param $id
     * @return static
     */
    public function actionDelete($id){
        $query = Category::findOne($id)->toArray();
        if($query) {

        }
        return $query;
    }

    public function actionUpdate($id, $name) {
        $data =  Category::findOne($id);
        $data->name = $name;
        $data->updated_at = date('Y-m-d H-i-s');
        $data->save();
        return $data;
    }

    public function actionView($id) {
        $currentCategory = Category::findOne($id);
        if($currentCategory == null) {
            Yii::$app->response->ok("No category of such exist", $id);
        }
        return $currentCategory;
    }
}