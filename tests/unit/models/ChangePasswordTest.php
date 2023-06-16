<?php

namespace unit\models;

use app\models\ChangePassword;
use app\models\User;
use Codeception\PHPUnit\TestCase;

class ChangePasswordTest extends TestCase
{
    public function testCorrectChangePassword()
    {
        $oldPassword = '123';
        $form = \Codeception\Stub::make(ChangePassword::class, ['change' => true, 'validate' => true]);
        $user = \Codeception\Stub::make(User::class, ['getId' => '1']);
        $user->passwordHash = \Yii::$app->security->generatePasswordHash($oldPassword);
        \Yii::$app->user->identity = $user;
        $form->currentPassword = $oldPassword;
        $form->newPassword = 'newPass';
        $form->confirmNewPassword = 'newPass';
        $this->assertTrue($form->validate());
        $this->assertTrue($form->change());
    }

    public function testNotCorrectCurrentPasswordChangePassword()
    {
        $oldPassword = '123';
        $form = \Codeception\Stub::make(ChangePassword::class, ['change' => false, 'validate' => false]);
        $user = \Codeception\Stub::make(User::class, ['getId' => '1']);
        $user->passwordHash = \Yii::$app->security->generatePasswordHash($oldPassword);
        \Yii::$app->user->identity = $user;
        $form->currentPassword = $oldPassword . '1';
        $form->newPassword = 'newPass';
        $form->confirmNewPassword = 'newPass';
        $this->assertFalse($form->validate());
        $this->assertFalse($form->change());
    }

    public function testNotCorrectChangePasswordEmptyFields()
    {
        $oldPassword = '123';
        $form = \Codeception\Stub::make(ChangePassword::class, ['change' => false, 'validate' => false]);
        $user = \Codeception\Stub::make(User::class, ['getId' => '1']);
        $user->passwordHash = \Yii::$app->security->generatePasswordHash($oldPassword);
        \Yii::$app->user->identity = $user;
        $form->currentPassword = $oldPassword;
        $form->newPassword = 'newPass';
        $form->confirmNewPassword = 'newPass1';
        $this->assertFalse($form->validate());
        $this->assertFalse($form->change());
    }

    public function testNotCorrectChangePasswordDbError()
    {
        $oldPassword = '';
        $form = \Codeception\Stub::make(ChangePassword::class, ['change' => false, 'validate' => false]);
        $user = \Codeception\Stub::make(User::class, ['getId' => '1', 'save' => false]);
        $user->passwordHash = \Yii::$app->security->generatePasswordHash($oldPassword);
        \Yii::$app->user->identity = $user;
        $form->currentPassword = $oldPassword;
        $form->newPassword = 'newPass';
        $form->confirmNewPassword = 'newPass';
        $this->assertFalse($form->validate());
        $this->assertFalse($form->change());
    }
}
