<?php

namespace app\controllers;

use app\models\Article;
use app\models\Comment;
use app\models\CommentForm;
use app\models\SignupForm;
use app\models\UserImage;
use app\models\UserImageForm;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Article::find();
        $countArticles = $query->count();
        $pages = new Pagination(['totalCount' => $countArticles, 'pageSize' => 16]);
        $articles = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render(
            'index',
            [
                'articles' => $articles,
                'pages' => $pages,
            ]
        );
    }

    public function actionArticle($id)
    {
        $article = Article::findOne($id);
        $comments = Comment::find()->where(['article_id' => $id])->all();
        $commentForm = new CommentForm();

        if ($article) {
            $article->addView();
            return $this->render(
                'article',
                [
                    'article' => $article,
                    'commentForm' => $commentForm,
                    'comments' => $comments,
                ]
            );
        } else {
            return $this->goHome();
        }
    }

    public function actionComment($article_id)
    {
        $commentForm = new CommentForm();
        if ($commentForm->load(Yii::$app->request->post())) {
            $commentForm->saveComment($article_id);
        }
        return $this->redirect(['site/article', 'id' => $article_id]);
    }

    public function actionUserImage()
    {
        $image = new UserImage();

        if ($image->load(Yii::$app->request->post())) {
            $imageFile = UploadedFile::getInstance($image, 'image');
            if ($imageFile) {
                $user = Yii::$app->user->identity;
                $user->saveImage($image->uploadImage($imageFile, $user->image));
            }
            return $this->goBack();
        }

        return $this->render(
            'user-image',
            [
                'image' => $image,
            ]
        );
    }
}
