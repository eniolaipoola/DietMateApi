<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 11/28/17
 * Time: 5:41 PM
 */

namespace app\controllers;

use app\models\IdealWeight;
use yii\rest\ActiveController;

class IdealWeightController extends ActiveController
{
    public function actionIndex(){
        $details = IdealWeight::find()->all();
        return $details;
    }


}