<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\Bmi;
use yii\base\Exception;
use yii\rest\Controller;

class BmiController extends Controller
{
    public function actionIndex(){
        $data = Bmi::find()->all();
        Yii::$app->response->ok('BMI Details', $data);
    }

    public function actionCreate(){
        try{
            $data = new Bmi();
            $data->attributes = Yii::$app->request->bodyParams;
            if(isset($data['class']) && !empty($data['upper_bound']) && isset($data['lower_bound'])){
                $bmiRange = $data->range($data['lower_bound'], $data['upper_bound']);
                $data->range = $bmiRange;
                $data->save();
                Yii::$app->response->ok('Bmi Class is successfully created', $data);
            }

        } catch (Exception $e){
            Yii::$app->response->internalServerError('Something went wrong, please try again', $e);
        }
    }

    public function actionUpdateRange($id, $range){
        $current = Bmi::findOne($id);
        if($current){
            $current->range = $range;
            $current->updated_at = date("Y-m-d H:i:s");
            $current->save();
            Yii::$app->response->ok('Range of BMI class is successfully updated', $current);
        } else {
            Yii::$app->response->notfound(" BMI class is not found");
        }
    }

    public function inference($bmi){
        $inference = '';
        //Notifies users of their bmi status!!!
        if($bmi > 0 && $bmi <= 18.4){
            $inference = "According to the details you supplied, your Body mass index shows that you are underweight";
        } else if($bmi >= 18.5 && $bmi <= 24.9 ) {
            $inference = "Your body mass index is normal for your weight";
        } else if($bmi >= 25.0 && $bmi <= 34.9) {
            $inference = "Your body mass index shows that you are overweight";
        } else if($bmi >= 35.0 && $bmi <= 39.9) {
            $inference = "Your body mass index shows that you are Obese";
        } else if($bmi >= 40 && $bmi <= 99.9) {
            $inference = "Your BMI is quite high, you have an obesity class of 3. This makes you more prone to Cardiovascular Diseases.";
        } else {
            Yii::$app->response->notFound("Invalid range is entered");
        }
        Yii::$app->response->ok("ok", $inference);
    }

    public function actionCalcBmi(){
        $user = new User(['scenario' => User::SCENARIO_USER]);
        try {
            $user->attributes = Yii::$app->request->bodyParams;
            if (isset($user['firstname']) && !empty($user['height']) && isset($user['weight'])) {
                $bmi = $user->calcBmi($user['height'], $user['weight']);
                $user->bmi = $bmi;
                $user->save();
                Yii::$app->response->ok('Your body mass index is', $bmi);
            } else {
                Yii::$app->response->badRequest('Please fill in the required fields', $user->getErrors());
            }
        } catch (Exception $e) {
            Yii::$app->response->notFound('An error occurred, please try again');
        }
    }

    public function actionSummary($bmi) {
        $this->inference($bmi);
    }
}