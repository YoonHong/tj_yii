<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $username;
    public $email;
    public $password;
    public $id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
//            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
 //           ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required', 'on' => self::SCENARIO_CREATE],
            ['password', 'string', 'min' => 6],

        ];
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_CREATE => ['username', 'email', 'password'],
            self::SCENARIO_UPDATE => ['email', 'password'],
        ];
    }


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }

    public function saveUser()
    {
      $user = new User();
      $user->username = $this->username;
      $user->email = $this->email;
      $user->setPassword($this->password);
      $user->generateAuthKey();
      if ($user->save()) {
          return $user;
      }

      return null;
    }

    public function updateUser($user)
    {
      $user->email = $this->email;
      $user->setPassword($this->password);
      $user->removePasswordResetToken();
      if ($user->save(false)) {
          return $user;
      }

      return null;
    }
}
