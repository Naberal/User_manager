<?php
declare(strict_types=1);

namespace App\User\Domain\Entities;

use App\User\Domain\VO\Login;
use App\User\Domain\VO\Password;
use App\User\Domain\VO\Phone;
use App\User\Domain\VO\UserId;
use App\User\Infrastructure\DB\DbUserRepository;
use App\User\Infrastructure\DB\DoctrineTypes\LoginType;
use App\User\Infrastructure\DB\DoctrineTypes\PasswordType;
use App\User\Infrastructure\DB\DoctrineTypes\PhoneType;
use App\User\Infrastructure\DB\DoctrineTypes\UserIdType;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DbUserRepository::class)]
#[ORM\Table(name: 'users')]
#[ORM\UniqueConstraint(columns: ['login', 'password'])]
class User
{
    public function __construct(
        #[ORM\Id, ORM\Column(name: "id", type: UserIdType::NAME, length: 8, options: ['fixed' => true])]
        public readonly UserId $id,
        #[ORM\Column(name: "login", type: LoginType::NAME, length: 8)]
        private Login          $login,
        #[ORM\Column(name: "phone", type: PhoneType::NAME, length: 8)]
        private Phone          $phone,
        #[ORM\Column(name: "password", type: PasswordType::NAME, length: 8)]
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
