<?php

namespace app\modules\group\controllers;

use app\models\User;
use app\modules\group\models\Group;
use app\modules\group\models\GroupForm;
use PHPUnit\Exception;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupAdminController implements the CRUD actions for Group model.
 */
class GroupAdminController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['index', 'view', 'delete-from-group', 'add-users'],
                        'allow' => true,
                        'roles' => ['teacher'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Group models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Group::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Group model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $form = new GroupForm();

        if ($this->request->isPost) {
            if ($form->load($this->request->post()) && $form->validate()) {
                $group = new Group();
                $group->name = $form->name;
                $group->save();

                $users = User::findAll($form->users);
                if (!empty($users)) {
                    foreach ($users as $user) {
                        $group->link('users', $user);
                    }
                }

                return $this->redirect(['update', 'id' => $group->id]);
            }
        }

        return $this->render('create', [
            'model' => $form,
        ]);
    }

    public function actionAddUsers(int $groupId)
    {
        $model = new GroupForm();

        if ($this->request->isPost) {
            $post = $this->request->post('GroupForm');
            $model->newUsers = User::findAll(['id' => $post['newUsers']]);
            $group = $this->findModel($groupId);

            foreach ($model->newUsers as $user) {
                try {
                    $group->link('users', $user);
                } catch (\Exception $e) {
                    continue;
                }
            }

            return $this->redirect(['update', 'id' => $groupId]);
        }
    }

    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $form = new GroupForm();
        $form->name = $model->name;
        $form->id = $model->id;
        $form->users = $model->users;

        if ($this->request->isPost) {
            if ($form->load($this->request->post()) && $form->validate()) {
                $group = Group::findOne(['id' => $form->id]);
                $group->name = $form->name;
            }
        }

        return $this->render('update', ['formModel' => $form]);
    }

    /**
     * Deletes an existing Group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionDeleteFromGroup(int $userId, int $groupId)
    {
        $group = Group::findOne(['id' => $groupId]);
        $user = User::findOne(['id' => $userId]);

        $group->unlink('users', $user, true);
        $this->redirect(['update', 'id' => $groupId]);
    }

    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Group::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
