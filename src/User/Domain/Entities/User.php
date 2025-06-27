<?php
declare(strict_types=1);

namespace App\User\Domain\Entities;

use App\User\Domain\VO\Login;
use App\User\Domain\VO\Password;
use App\User\Domain\VO\Phone;
use App\User\Domain\VO\UserId;

class User
{
    public function __construct(
        public readonly UserId $id,
        private Login          $login,
        private Phone          $phone,
        private Password       $password,
    ) {
    }

    public function changeLogin(Login $newLogin): void
    {
        $this->login = $newLogin;
    }

    public function changePassword(Password $newPassword): void
    {
        $this->password = $newPassword;
    }

    public function changePhone(Phone $newPhone): void
    {
        $this->phone = $newPhone;
    }

    public function getLogin(): Login
    {
        return $this->login;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getPhone(): Phone
    {
        return $this->phone;
    }
}
