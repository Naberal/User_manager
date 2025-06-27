<?php
declare(strict_types=1);

namespace App\User\Domain\Service;

use App\User\Domain\Entities\User;
use App\User\Domain\VO\UserId;

interface UserRepository
{
    public function add(User $user): void;

    public function delete(UserId $id): void;

    public function getById(UserId $id): ?User;

    public function update(User $user): void;
}
