<?php
namespace app\modules\blog\controllers;

use Yii;
use app\modules\blog\models\Article;
use yii\rest\Controller;
use yii\base\Exception;


class ArticleController extends Controller
{
    public function actionIndex() {
        $data = Article::find()
            ->all();
        Yii::$app->response->ok('All Users', $data);
    }

    public function actionCreate() {
        $article = new Article();
        try {
            $article->attributes = Yii::$app->request->bodyParams;
            if (isset($article['title']) && !empty($article['description'])) {
                $article->save();
                Yii::$app->response->ok('Article is successfully registered', $article);
            } else {
                Yii::$app->response->badRequest('Something is not right', $article->getErrors());
            }
        } catch (Exception $e) {
            Yii::$app->response->notFound('An error occurred, please try again');
        }
    }
}