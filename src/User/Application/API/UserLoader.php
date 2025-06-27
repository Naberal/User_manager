<?php
declare(strict_types=1);

namespace App\User\Application\API;

use App\User\Domain\Entities\User;
use App\User\Domain\VO\UserId;

interface UserLoader
{
    public function loadById(UserId $id): ?User;
}
