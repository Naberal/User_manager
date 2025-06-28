<?php
declare(strict_types=1);

namespace App\User\Infrastructure\DB;

use App\User\Domain\Entities\User;
use App\User\Domain\Service\UniqueUserChecker;
use App\User\Domain\Service\UserRepository;
use App\User\Domain\VO\Login;
use App\User\Domain\VO\Password;
use App\User\Domain\VO\UserId;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DbUserRepository extends ServiceEntityRepository implements UserRepository, UniqueUserChecker
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $user): void
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function delete(UserId $id): void
    {
        $user = $this->getById($id);
        if ($user === null) {
            return;
        }
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
    }

    public function getById(UserId $id): ?User
    {
        return $this->find($id->id);
    }

    public function update(User $user): void
    {
        $this->getEntityManager()->flush();
    }

    public function isUnique(Login $login, Password $password): bool
    {
        return $this->findOneBy(['login' => $login, 'password' => $password]) === null;
    }
}
