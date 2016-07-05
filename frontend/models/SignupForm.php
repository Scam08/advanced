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
    public $username;
    public $email;
    public $password;
    public $repassword;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'], // Убирает проблемы слева и справа от имени
            [['username','password','repassword'], 'required','message' => 'Обязательно к заполнению'],   // Проверяет, является ли вход. знач. не пустым
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Это имя пользователя уже используется.'],
             /*
            Проверяет является ли данное имя уникальным */
            ['username', 'string', 'min' => 2, 'max' => 255], //Устанавливает диапазон символов для имени

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required','message' => 'Обязательно к заполнению'],
            ['email', 'email','message' => 'Некорректный e-mail'], // Валидатор проверяет, что входящие данные явл-ся корректным е-майл
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Этот email уже используется.'],


            ['password', 'string', 'min' => 6,'message' => 'Минимальная длина пароля - 6 символов'],


            ['repassword','compare','compareAttribute' => 'password','message' => 'Поля "Пароль" и "Повторите пароль" должны совпадать'], // Сравнивает repassword с password
        ];
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
       /* $scenarios['short_register'] = ['email','username']; // Сценарий - определенный набор. Напр. валидация для определенных значений
        $scenarios['short_register1'] = ['repassword','email','username']; // Сценарий - определенный набор. Напр. валидация для определенных значений
    */
       return $scenarios;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        return $user->save() ? $user : null;
    }
}
