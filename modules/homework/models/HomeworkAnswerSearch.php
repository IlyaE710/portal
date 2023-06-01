<?php

namespace app\modules\homework\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\homework\models\HomeworkAnswer;

/**
 * HomeworkAnswerSearch represents the model behind the search form of `app\modules\homework\models\HomeworkAnswer`.
 */
class HomeworkAnswerSearch extends HomeworkAnswer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'studentId', 'homeworkId'], 'integer'],
            [['content'], 'safe'],
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
        $query = HomeworkAnswer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'studentId' => $this->studentId,
            'homeworkId' => $this->homeworkId,
        ]);

        $query->andFilterWhere(['ilike', 'content', $this->content]);

        return $dataProvider;
    }
}
