<?php
declare(strict_types=1);

namespace App\User\Application\API;

use App\User\Domain\Entities\User;
use App\User\Domain\Service\UniqueUserChecker;
use App\User\Domain\Service\UserRepository;
use App\User\Domain\VO\Login;
use App\User\Domain\VO\Password;
use App\User\Domain\VO\Phone;
use App\User\Domain\VO\UserId;
use DomainException;
use InvalidArgumentException;

class UserManager implements UserUpdater, UserRemover, UserCreator
{
    public function __construct(
        private readonly UserRepository    $repository,
        private readonly UniqueUserChecker $uniqueUserChecker,
    ) {
    }

    /**
     * @throws DomainException
     * @throws InvalidArgumentException
     */
    public function create(Login $login, Password $password, Phone $phone): User
    {
        $this->validateUserCredentials($login, $password);
        $user = new User(UserId::generate(), $login, $phone, $password);
        $this->repository->add($user);
        return $user;
    }

    public function remove(UserId $id): void
    {
        $this->repository->delete($id);
    }

    /**
     * @throws DomainException
     */
    public function update(UserId $id, Login $newLogin, Password $newPassword, Phone $newPhone): void
    {
        $user = $this->repository->getById($id);
        if ($user === null) {
            return;
        }
        $this->validateUserCredentials($newLogin, $newPassword);
        $user->changeLogin($newLogin);
        $user->changePassword($newPassword);
        $user->changePhone($newPhone);
        $this->repository->update($user);
    }

    /**
     * @param Login $login
     * @param Password $password
     * @return void
     * @throws DomainException
     */
    public function validateUserCredentials(Login $login, Password $password): void
    {
        if (!$this->uniqueUserChecker->isUnique($login, $password)) {
            throw new DomainException("Such credentials already used");
        }
    }
}
