<?php
namespace app\controllers;


use Yii;
use app\models\User;
use yii\base\Exception;
use yii\rest\Controller;

class UserController extends Controller
{
    public function actionIndex() {
        $data = User::find()
            ->all();
        Yii::$app->response->ok('All Users', $data);
    }

    public function actionLogin() {
        $data = Yii::$app->request->bodyParams;
        try{
            if(isset($data['email']) && isset($data['password'])){
                $user = User::findOne(['email' => $data['email']]);
                $check = $user->validatePassword($data['password']);
                if($check) {
                    Yii::$app->response->ok("You are successfully logged in", $data);
                }
            } else {
                Yii::$app->response->badRequest("Invalid username or password");
            }
        } catch (Exception $e) {
            return "Something went wrong";
        }
    }

    public function actionView($id) {
        $user = User::find()->where(['id' => $id]);
        if ($user) {
            Yii::$app->response->ok('View User', $user->all());
        }
    }

    public function actionSignUp(){
        $data = new User();
        $data->attributes = Yii::$app->request->bodyParams;
        if(empty($data['email']) || empty($data['password'])) {
            Yii::$app->response->badRequest('Please input your email or password', $data->getErrors());
        }
        $check = User::findOne($data['email']);
        if ($check){
            Yii::$app->response->badRequest('Invalid email or password');
        }
        $data->generateHash($data['password']);
        $data->save();
        Yii::$app->response->ok("Sucessful", $data);
    }

    public function actionCreateDietitian() {
        $user = new User(['scenario' => User::SCENARIO_DIETITIAN]);
        try {
            $user->attributes = Yii::$app->request->bodyParams;
            if (isset($user['email']) && !empty($user['password'])) {
                $user->generateHash($user['password']);
                $user->role_id = 2;
                $user->save();
                Yii::$app->response->ok('User is successfully registered', $user);
            } else {
                Yii::$app->response->badRequest('Something is not right', $user->getErrors());
            }
        } catch (Exception $e) {
            Yii::$app->response->notFound('An error occurred, please try again');
        }
    }

    public function actionCreateUser(){
        $user = new User();
        try {
            $user->attributes = Yii::$app->request->bodyParams;
            if (isset($user['email']) && !empty($user['password'])) {
                $check = $user->find()->from('users')->where('email' == $user['email']);
                if($check) {
                    Yii::$app->response->badRequest("Email already exists", $user->getErrors());
                }
                $user->role_id = 1;
                $user->generateHash($user['password']);
                $user->save();
                Yii::$app->response->ok('User is successfully registered', $user);
            } else {
                Yii::$app->response->badRequest('Please fill in the required fields', $user->getErrors());
            }
        } catch (Exception $e) {
            Yii::$app->response->notFound('An error occurred, please try again');
        }
    }
}