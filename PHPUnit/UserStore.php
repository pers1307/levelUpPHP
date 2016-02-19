<?php

class UserStore
{
    private $users = [];

    function addUser($name, $mail, $pass)
    {
        if (isset($this->users[$mail])) {
            throw new \Exception(
                'Пользователь уже зарегистрирован.'
            );
        }

        if (mb_strlen($pass) < 5) {
            throw new \Exception(
                'Длина пароля должна быть не менее 5 символов.'
            );
        }

        $this->users[$mail] = [
            'pass' => $pass,
            'mail' => $mail,
            'name' => $name
        ];

        return true;
    }

    function notifyPasswordFailure($mail)
    {
        if (isset($this->users[$mail])) {
            $this->users[$mail]['failed'] = time();
        }
    }

    function getUser($mail)
    {
        return $this->users[$mail];
    }
}

class Validator
{
    private $store;

    public function __construct(UserStore $store)
    {
        $this->store = $store;
    }

    public function validateUser($mail, $pass)
    {
        if (!is_array($user = $this->store->getUser($mail))) {
            return false;
        }

        if ($user['pass'] === $pass) {
            return true;
        }

        $this->store->notifyPasswordFailure($mail);

        return false;
    }
}