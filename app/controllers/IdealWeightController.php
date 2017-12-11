<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\IdealWeight;
use yii\rest\Controller;

class IdealWeightController extends Controller
{
    public function actionIndex(){
        $details = IdealWeight::find()->all();
        return $details;
    }

    public function actionCalc($email){
        $model = new User();
        $ibwModel = new IdealWeight();
        $data = Yii::$app->request->bodyParams;
        if(isset($data['sex_id']) && isset($data['height'])){
            $user = $model::findOne(['email' => $email]);
            $ibw = $ibwModel->calcIBW($data['sex_id'], $data['height']);
            if($user){
                $user->ibw = $ibw;
                $user->save();
            }
            Yii::$app->response->ok("Your ideal body weight is ", $ibw);
        } else {
            Yii::$app->response->badRequest("Something went wrong");
        }
    }

    public function actionTest(){
        $model = new IdealWeight();
        return $model->calcIBW(1, 156);
      // return $model->calcHanwiIncrementFemale(190);
    }
}