<?php

use yii\db\Migration;

/**
 * Class m230512_223120_rbac
 */
class m230512_223120_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Назначаем роли и разрешения
        $auth = Yii::$app->authManager;

        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);

        $studentRole = $auth->createRole('student');
        $auth->add($studentRole);

        $teacherRole = $auth->createRole('teacher');
        $auth->add($teacherRole);

        $bannedRole = $auth->createRole('banned');
        $auth->add($bannedRole);

        // Связываем разрешения с ролями
        $auth->addChild($adminRole, $teacherRole);

        $user = new \app\models\User();
        $user->firstname = 'admin';
        $user->lastname = 'admin';
        $user->patronymic = 'admin';
        $user->passwordHash = Yii::$app->security->generatePasswordHash('admin');
        $user->email = 'admin@mail.com';
        $user->role = 'admin';
        $user->save();

        // Назначаем роли пользователям
        $auth->assign($adminRole, $user->id);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230512_223120_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230512_223120_rbac cannot be reverted.\n";

        return false;
    }
    */
}
