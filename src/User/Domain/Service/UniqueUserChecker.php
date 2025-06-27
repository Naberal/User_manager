<?php
declare(strict_types=1);

namespace App\User\Domain\Service;

use App\User\Domain\VO\Login;
use App\User\Domain\VO\Password;

interface UniqueUserChecker
{
    /**
     * Check that a login password pair is unique in the app
     */
    public function isUnique(Login $login, Password $password): bool;
}
