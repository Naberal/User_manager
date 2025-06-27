<?php
declare(strict_types=1);

namespace App\User\Domain\VO;

use InvalidArgumentException;

readonly class Login
{
    private const int LENGTH = 8;

    /**
     * @param string $login
     * @throws InvalidArgumentException
     */
    public function __construct(public string $login)
    {
        $trimmedLogin = trim($login);
        if (strlen($trimmedLogin) !== strlen($this->login)) {
            throw new InvalidArgumentException('Login contains whitespace');
        }
        if (empty($trimmedLogin) || strlen($trimmedLogin) > self::LENGTH) {
            throw new InvalidArgumentException("Login must be for 1 to " . self::LENGTH . " characters long");
        }
    }

    public function __toString(): string
    {
        return $this->login;
    }
}
