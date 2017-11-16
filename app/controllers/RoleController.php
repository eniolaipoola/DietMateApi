<?php


namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\Role;


class RoleController extends Controller {

    public function actionIndex() {
        $data = Role::find()
            ->all();
        Yii::$app->response->ok('Available Roles', $data);
    }

    public function actionCreate() {
        $roles = new Role();
        $roles->attributes = Yii::$app->request->bodyParams;
        if(isset($roles->name)) {
            $roles->save();
            Yii::$app->response->ok('Successfully created', $roles);
        }
    }

}