<?php

namespace app\modules\material\models;

use yii\data\ActiveDataProvider;

class MaterialSearch extends Material
{
    public $title;
    public $description;
    public $tags;
    public function rules() : array
    {
        return [
            [['title', 'description', 'tags'], 'string'],
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
            ->leftJoin('material_tag mt', 'mt."material_id" = material.id')
            ->leftJoin('tag t', 't."id" = mt."tag_id"')
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'LOWER(t.name)', strtolower($this->tags)]);

        return $dataProvider;
    }
}