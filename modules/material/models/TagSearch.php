<?php

namespace app\modules\material\models;

use yii\data\ActiveDataProvider;

class TagSearch extends Tag
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
        $query = Tag::find();

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