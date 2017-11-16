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
        Yii::$app->response->ok('Composed Articles', $data);
    }

    public function actionCreate($id) {
        $article = new Article();
        /*try {*/
            $article->attributes = Yii::$app->request->bodyParams;
            if (isset($article['title']) && !empty($article['description'])) {
                $article->author_id = $id;
                $article->save();
                Yii::$app->response->ok('Article is successfully created', $article);
            } else {
                Yii::$app->response->badRequest('Something is not right', $article->getErrors());
            }
      /*  } catch (Exception $e) {
            Yii::$app->response->notFound('An error occurred, please try again');
        }*/
    }

    public function actionView($id){
        $currentArticle = Article::findOne($id);
        if($currentArticle == null) {
            Yii::$app->response->notFound("Article not found");
        }
        return $currentArticle;
    }

    public function actionEdit($id){
        $data = Article::findOne($id);
        $data->attributes = Yii::$app->request->bodyParams;
        if(isset($data['title']) || isset($data['description'])){
            $data->title = $data['title'];
            $data->description = $data['description'];
            $data->updated_at = date('Y-m-d H:i:s');
            $data->save();
            Yii::$app->response->ok("Article is successfully edited", $data);
        } else {
            Yii::$app->response->badRequest("Invalid request made");
        }

    }
}