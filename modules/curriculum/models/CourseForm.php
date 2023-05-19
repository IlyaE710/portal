<?php

namespace app\modules\curriculum\models;

use Yii;
use yii\base\Model;

class CourseForm extends Model
{
    public $image;

    public function rules()
    {
        return [
            [['image'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $salt = Yii::$app->security->generateRandomString();

            $this->image->saveAs(Yii::getAlias('@app/web/uploads/courses/') . md5($this->image->baseName.$salt) . '.' . $this->image->extension);

            return true;
        }

        return false;
    }
}