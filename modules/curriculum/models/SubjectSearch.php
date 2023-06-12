<?php

namespace app\modules\curriculum\models;

use yii\data\ActiveDataProvider;

class SubjectSearch extends Subject
{
    public $name;
    public function rules() : array
    {
        return [
            [['name'], 'string'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Subject::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Загружаем данные формы поиска и применяем фильтры
        if (!$this->load($params) || !$this->validate()) {
            return $dataProvider;
        }

        // Применяем фильтры к запросу
        $query
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}