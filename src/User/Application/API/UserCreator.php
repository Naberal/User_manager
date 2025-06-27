<?php
declare(strict_types=1);

namespace App\User\Application\API;

use App\User\Domain\Entities\User;
use App\User\Domain\VO\Login;
use App\User\Domain\VO\Password;
use App\User\Domain\VO\Phone;

interface UserCreator
{
    public function create(Login $login, Password $password, Phone $phone): User;
}
