<?php
declare(strict_types=1);

namespace App\User\Application\API;

use App\User\Domain\VO\UserId;

interface UserRemover
{
    public function remove(UserId $id): void;
}
