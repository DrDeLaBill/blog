<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property string|null $content
 * @property string|null $date
 * @property string|null $image
 * @property int|null $viewed
 * @property int|null $user_id
 * @property int|null $status
 * @property int|null $category_id
 *
 * @property Category $category
 * @property User $user
 * @property ArticleTag[] $articleTags
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['content'], 'string'],
            [['date'], 'date', 'format' => 'php:Y-m-d'],
            [['date'], 'default', 'value' => date('Y-m-d')],
            [['status'], 'default', 'value' => 0],
            [['viewed'], 'default', 'value' => 0],
            [['title', 'description', 'image'], 'string', 'max' => 255],
            [['category_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'content' => 'Content',
            'date' => 'Date',
            'image' => 'Image',
            'viewed' => 'Viewed',
            'user_id' => 'User ID',
            'status' => 'Status',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[ArticleTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticleTags()
    {
        return $this->hasMany(ArticleTag::className(), ['article_id' => 'id']);
    }

    public function getTags()
    {
        return $this->hasMany(ArticleTag::className(), ['id' => 'tag_id'])->viaTable(
            'article_tag',
            ['article_id' => 'id']
        );
    }

    public function saveImage($image)
    {
        $this->image = $image;
        return $this->save(false);
    }

    private function deleteImage()
    {
        $imageModel = new ImageUpload();
        $imageModel->deleteFile($this->image);
    }

    public function beforeDelete()
    {
        $this->deleteImage();
        return parent::beforeDelete();
    }

    public function beforeSave($insert)
    {
        $this->user_id = Yii::$app->user->identity->getId();
        return parent::beforeSave($insert);
    }

    public function getImage()
    {
        return ($this->image) ? '/uploads/' . $this->image : '/default.jpg';
    }

    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->date);
    }

    public function addView()
    {
        if (Yii::$app->user->isGuest) {
            return;
        }
        $this->viewed++;
        $this->save(false);
    }
}
