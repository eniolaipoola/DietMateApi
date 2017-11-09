<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 9/29/17
 * Time: 12:22 AM
 */

namespace app\controllers;

use Yii;
use yii\rest\Controller;
use app\models\Role;


class RoleController extends Controller {

    public function actionIndex() {
        $data = Role::find()
            ->all();
        Yii::$app->response->ok('ALL USERS', $data);
    }

    public function actionCreate() {
        $roles = new Role();
        $roles->attributes = Yii::$app->request->bodyParams;
        if(isset($roles->name)) {
            Yii::$app->response->ok('Successfully created');
        }
    }

}