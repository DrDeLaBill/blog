<?php

namespace app\modules\admin\controllers;

use app\models\ArticleTag;
use app\models\Category;
use app\models\ImageUpload;
use app\models\Tag;
use Yii;
use app\models\Article;
use app\models\ArticleSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();
        $image = new ImageUpload();
        $tags = Tag::getAllTags();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveImage($model, $image);
            $this->saveTags($model);
            //$model->user = Yii::$app->request->getAuthUser();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'image' => $image,
            'selectedTags' => [],
            'tags' => $tags,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image = new ImageUpload();
        $selectedTags = ArrayHelper::getColumn(ArticleTag::find()->where(['article_id' => $id])->all(), 'tag_id');
        $tags = Tag::getAllTags();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->saveImage($model, $image);
            $this->saveTags($model);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'image' => $image,
            'selectedTags' => $selectedTags,
            'tags' => $tags,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private function saveImage(Article $model, ImageUpload $image)
    {
        $imageFile = UploadedFile::getInstance($image, 'image');
        if ($imageFile) {
            $model->saveImage($image->uploadImage($imageFile, $model->image));
        }
    }

    public function saveTags($article)
    {
        $tagIds = Yii::$app->request->post('tags');
        ArticleTag::clearArticleTags($article);
        ArticleTag::saveArticleTags($article, $tagIds);
    }

}
