<?php

namespace app\modules\curriculum\controllers;

use app\modules\curriculum\models\EventPattern;
use app\modules\homework\models\Homework;
use app\modules\material\models\Material;
use Exception;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class EventPatternTeacherController extends \yii\web\Controller
{
    public function actionIndex(int $id): string
    {
        $dataProvider = new ActiveDataProvider([
            'query' => EventPattern::find()->where(['curriculumId' => $id])
                ->andWhere(['lectorId' => Yii::$app->user->identity->id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'id' => $id,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $materialIds = $this->request->post('EventPattern')['materials'];
            $homeworkIds = $this->request->post('EventPattern')['homeworks'];
            if (!$model->validate() || !$model->save()) {
                throw new \yii\db\Exception('Не сохранились данные');
            }

            $transaction = Yii::$app->db->beginTransaction();
            try {
                if (!empty($this->request->post('EventPattern')['materials'])) {
                    $materials = Material::findAll($materialIds);
                    $model->unlinkAll('materials', true);

                    foreach ($materials as $material) {
                        $model->link('materials', $material);
                    }
                }

                if (!empty($this->request->post('EventPattern')['homeworks'])) {
                    $homeworks = Homework::findAll($homeworkIds);
                    $model->unlinkAll('homeworks', true);

                    foreach ($homeworks as $homework) {
                        $model->link('homeworks', $homework);
                    }
                }
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Произошла ошибка при обновлении записи:');
                return $this->redirect(['update', 'id' => $model->id]);
            }
            return $this->redirect(['index', 'id' => $model->curriculumId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = EventPattern::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}