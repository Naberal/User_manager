<?php
declare(strict_types=1);

namespace App\User\Application\API;

use App\User\Application\API\UserLoader;
use App\User\Domain\Entities\User;
use App\User\Domain\Service\UserRepository;
use App\User\Domain\VO\UserId;

class UserLoaderIml implements UserLoader
{

    public function __construct(private UserRepository $repository)
    {
    }

    public function loadById(UserId $id): ?User
    {
        return $this->repository->getById($id);
    }
}
