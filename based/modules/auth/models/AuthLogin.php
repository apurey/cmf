<?php

namespace app\modules\auth\models;

use Yii;
use app\modules\auth\models\Auth;

class AuthLogin extends Auth
{
    /**
     * @var null
     */
    public $verifyCode = null;

    /**
     * @var Auth
     */
    private $user = null;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['login'], 'string', 'max' => 32],
            [['password'], 'string', 'max' => 512, 'min' => 8],
            [['login', 'password'], 'required'],
            ['password', 'authorization'],
            ['verifyCode', 'captcha', 'captchaAction' => '/cp/auth/default/captcha'],
        ];
    }

    public function authorization()
    {
        if (!$this->hasErrors()) {
            if (!$this->getUser() || !$this->getUser()->validatePassword($this->password)) {
                $this->addError('password', Yii::t('auth', 'Incorrect username or password'));
            }
        }
    }

    /**
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        } else {
            return false;
        }
    }

    /**
     * @return Auth|static
     */
    public function getUser()
    {
        if ($this->user === null) {
            $this->user = Auth::findOne(['login' => $this->login, 'blocked' => Auth::BLOCKED_NO]);
        }
        return $this->user;
    }
}
