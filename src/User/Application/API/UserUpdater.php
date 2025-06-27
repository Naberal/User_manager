<?php
declare(strict_types=1);

namespace App\User\Application\API;

use App\User\Domain\VO\Login;
use App\User\Domain\VO\Password;
use App\User\Domain\VO\Phone;
use App\User\Domain\VO\UserId;

interface UserUpdater
{
    public function update(UserId $id, Login $newLogin, Password $newPassword, Phone $newPhone): void;
}
