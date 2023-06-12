<?php

namespace app\modules\curriculum\models;

use app\modules\group\models\Group;
use Yii;
use yii\data\ActiveDataProvider;

class CurriculumSearch extends Curriculum
{
    public $groupName;
    public $description;
    public $semester;
    public $subject;
    public function rules(): array
    {
        return [
            [['groupName', 'description', 'subject'], 'safe'],
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

    public function search($params): ActiveDataProvider
    {
        $groupIds = null;
        $query = Curriculum::find();

        if (Yii::$app->user->identity->role === 'student') {
            foreach (Yii::$app->user->identity->groups as $group) {
                $groupIds[] = $group->id;
            }
            $query->where(['groupId' => $groupIds]);
        }

        if (Yii::$app->user->identity->role === 'teacher') {
            $query
                ->leftJoin('event', 'event."lectorId" = ' . Yii::$app->user->identity->id);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query
            ->andFilterWhere(['groupId' => $this->groupName])
            ->andFilterWhere(['subjectId' => $this->subject]);

        return $dataProvider;
    }
}