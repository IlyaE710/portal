<?php

namespace app\modules\curriculum\models;

use app\models\User;
use app\modules\group\models\Group;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\curriculum\models\Curriculum;

/**
 * CurriculumAdminSearch represents the model behind the search form of `app\modules\curriculum\models\Curriculum`.
 */
class CurriculumAdminSearch extends Curriculum
{
    public $subjectName;
    public $groupName;
    public $authorName;
    public $description;

    public function rules() : array
    {
        return [
            [['subjectName', 'groupName', 'authorName', 'description'], 'safe'],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'groupName' => 'Группа',
            'description' => 'Описание',
            'semester' => 'Семестр',
            'subject' => 'Прдеметы',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Curriculum::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            // Конфигурация провайдера данных, если необходимо
        ]);

        // Загружаем данные формы поиска и применяем фильтры
        if (!$this->load($params) || !$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith('subject');
        $query->joinWith('group');
//        $query->joinWith('author');

        // Применяем фильтры к запросу
        $query->andFilterWhere(['like', 'subject.name', $this->subjectName])
            ->andFilterWhere(['like', 'group.name', $this->groupName])
//            ->andFilterWhere(['like', 'author.firstname', $this->authorName])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
