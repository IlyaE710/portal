<?php

namespace app\modules\curriculum\models;

class SelectCurriculumForm extends \yii\base\Model
{
    public $idTemplate;
    public function rules(): array
    {
        return [
            [['idTemplate'], 'required'],
            [['idTemplate'], 'integer'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'idTemplate' => 'Шаблон',
        ];
    }
}