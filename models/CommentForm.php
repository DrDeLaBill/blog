<?php


namespace app\models;


use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $text;

    public function rules()
    {
        return [
            [['text'], 'required'],
            [['text'], 'string', 'length' => [3, 255]],
        ];
    }

    public function saveComment($article_id)
    {
        $comment = new Comment();
        $comment->text = $this->text;
        $comment->article_id = $article_id;
        $comment->user_id = Yii::$app->user->getId();
        $comment->status = 0;
        $comment->date = date('Y-m-d');
        return $comment->save(false);
    }
}