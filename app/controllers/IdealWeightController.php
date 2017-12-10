<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 11/28/17
 * Time: 5:41 PM
 */

namespace app\controllers;

use app\models\IdealWeight;
use yii\rest\Controller;

class IdealWeightController extends Controller
{
    public function actionIndex(){
        $details = IdealWeight::find()->all();
        return $details;
    }

    public function actionCalculateIdealWeight(){

    }

    public function actionTest(){
        $model = new IdealWeight();
        return $model->calcIBW(156, 1);
      // return $model->calcHanwiIncrementFemale(190);
    }
}