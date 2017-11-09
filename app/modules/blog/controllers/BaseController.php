<?php
/**
 * Created by PhpStorm.
 * User: ehnyn
 * Date: 10/24/17
 * Time: 12:21 AM
 */

namespace app\modules\blog\controllers;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\modules\blog\models\LoginForm;


class BaseController extends Controller
{
    public $layout = 'blogLayout';

    public function actionIndex() {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

}