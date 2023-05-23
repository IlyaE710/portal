<?php

namespace app\models;

use app\modules\group\models\Group;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "group".
 *
 * @property int $id
 * @property string $passwordHash
 * @property string $firstname
 * @property string $lastname
 * @property string $patronymic
 * @property string $email
 *
 * @property UserGroup[] $userGroups
 * @property User[] $users
 * @property Group[] $groups
 * @property string $role
 */


class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    private $fullname;
    const STATUS_ACTIVE = ['admin', 'teacher', 'student'];
    private static array $users = [
        '100' => [
            'id' => '100',
            'firstname' => 'admin',
            'patronymic' => 'admin',
            'lastname' => 'admin',
            'admin@mail.com' => 'admin',
            'role' => 'admin',
            'passwordHash' => '$2y$13$QxIN7Bo8iqvb4CvUQRSTbubbOpnlWn2swkwj3HlfOyc//RfC.T7Om',
        ],
    ];

    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'passwordHash'], 'required'],
            [['email', 'passwordHash', 'firstname', 'lastname', 'role'], 'string'],
            [['email'], 'email'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'firstname' => 'Имя',
            'patronymic' => 'Отчество',
            'lastname' => 'Фамилия',
            'email' => 'email',
            'role' => 'роль',
            'passwordHash' => 'Хэш пароля',
            'author' => 'Автор',
            'fullname' => 'Автор',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return User::find()->where(['id' => $id])->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return User|array|ActiveRecord|null
     */
    public static function findByEmail(string $email)
    {
        return self::find()->where(['email' => $email])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::class, ['id' => 'group_id'])->viaTable('user_group', ['user_id' => 'id']);
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public function isBanned(): bool
    {
        return $this->role === 'banned';
    }

    public function getFullname(): string
    {
        if (isset($this->lastname) && isset($this->firstname) && isset($this->patronymic)) {
            return $this->lastname . ' ' . $this->firstname[0] . '. ' . $this->patronymic[0] . '.';
        }
        return '(не задано)';
    }
}
