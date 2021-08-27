<?php


namespace app\models;


use yii\base\Model;

class UserImageForm extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'string', 'max' => 255]
        ];
    }

    public function saveUserImage()
    {

    }
}