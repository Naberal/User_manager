<?php
declare(strict_types=1);

namespace App\User\Domain\VO;

use InvalidArgumentException;

readonly class Password
{
    private const int LENGTH = 8;

    /**
     * @param string $password
     * @throws InvalidArgumentException
     */
    public function __construct(public string $password)
    {
        if (empty($password) || strlen($password) > self::LENGTH) {
            throw new InvalidArgumentException("Login must be for 1 to " . self::LENGTH . " characters long");
        }
    }

    public function __toString(): string
    {
        return $this->password;
    }
}
