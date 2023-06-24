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

        $teacher = new \app\models\User();
        $teacher->firstname = 'Петр';
        $teacher->lastname = 'Петров';
        $teacher->patronymic = 'Петрович';
        $teacher->passwordHash = Yii::$app->security->generatePasswordHash('teacher');
        $teacher->email = 'teacher@mail.com';
        $teacher->role = 'teacher';
        $teacher->save();

        // Назначаем роли пользователям
        $auth->assign($teacherRole, $teacher->id);

        $student = new \app\models\User();
        $student->firstname = 'Иван';
        $student->lastname = 'Иванович';
        $student->patronymic = 'Иванов';
        $student->passwordHash = Yii::$app->security->generatePasswordHash('student');
        $student->email = 'student@mail.com';
        $student->role = 'student';
        $student->save();

        // Назначаем роли пользователям
        $auth->assign($teacherRole, $student->id);
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
