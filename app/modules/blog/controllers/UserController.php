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
            if(isset($data['email']) && !empty($data['password'])){
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

    public function actionCreateUser() {
        $user = new User();
        try {
            $user->attributes = Yii::$app->request->bodyParams;
            if (isset($user['email']) && !empty($user['password'])) {
                $user->save();
                Yii::$app->response->ok('User is successfully registered', $user);
            } else {
                Yii::$app->response->badRequest('Something is not right', $user->getErrors());
            }
        } catch (Exception $e) {
            Yii::$app->response->notFound('An error occurred, please try again');
        }
    }
}