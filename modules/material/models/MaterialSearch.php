<?php

namespace app\modules\material\models;

use yii\data\ActiveDataProvider;

class MaterialSearch extends Material
{
    public $title;
    public $description;
    public function rules() : array
    {
        return [
            [['title', 'description'], 'string'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = Material::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // Конфигурация провайдера данных, если необходимо
        ]);

        // Загружаем данные формы поиска и применяем фильтры
        if (!$this->load($params) || !$this->validate()) {
            return $dataProvider;
        }

        // Применяем фильтры к запросу
        $query
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}