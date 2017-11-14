<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 11/9/17
 * Time: 10:09 PM
 */

namespace app\modules\blog\controllers;

use Yii;
use app\modules\blog\models\Status;
use yii\rest\Controller;

class StatusController extends Controller
{
    /**
     * DEfault view for all components of the endpoint.
     * @return array|\yii\db\ActiveRecord[]
     */
    public function actionIndex()
    {
        $model = new Status();
        $data = $model->find()->all();
        return $data;
    }

    /**
     * Action to create a new status
     * @return Status |string
     */
    public function actionCreate()
    {
        $model = new Status();
        $model->attributes = Yii::$app->request->bodyParams;
        if(isset($model->attributes))
        {
            $model->save();
        } else {
            Yii::$app->response->ok("No status is specified, therefore it cannot be created", $model);
        }
        return $model;
    }
}