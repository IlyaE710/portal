<?php

namespace app\modules\profile\models;

use app\models\User;
use yii\data\ActiveDataProvider;

class UserSearch extends \app\models\User
{
    public $firstname;
    public $latsname;
    public $patronymic;
    public $email;
    public $role;
    public function rules() : array
    {
        return [
            [['firstname', 'lastname', 'patronymic', 'role'], 'string'],
            [['email'], 'email'],
        ];
    }

    public function search($params): ActiveDataProvider
    {
        $query = User::find();

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
            ->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'description', $this->patronymic]);

        return $dataProvider;
    }
}