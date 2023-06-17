<?php

namespace app\modules\curriculum\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class CurriculumTeacherSearch extends Curriculum
{
    public $subjectName;
    public $groupName;
    public $authorName;
    public $description;
    public $semester;

    public function rules() : array
    {
        return [
            [['subjectName', 'groupName', 'authorName', 'description', 'authorName', 'semester'], 'safe'],
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
        $query = Curriculum::find()
            ->leftJoin('event', 'curriculum.id = event."curriculumId"')
            ->andWhere(['lectorId' => Yii::$app->user->identity->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        // Загружаем данные формы поиска и применяем фильтры
        if (!$this->load($params) || !$this->validate()) {
            return $dataProvider;
        }

        $query->joinWith('subject');
        $query->joinWith('group');
        $query->joinWith('author');

        // Применяем фильтры к запросу
        $query->andFilterWhere(['like', 'subject.name', $this->subjectName])
            ->andFilterWhere(['like', 'group.name', $this->groupName])
            ->andFilterWhere(['like', 'author.firstname', $this->authorName])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['=', 'semester', $this->semester]);

        return $dataProvider;
    }
}