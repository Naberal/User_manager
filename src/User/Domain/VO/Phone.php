<?php
declare(strict_types=1);

namespace App\User\Domain\VO;

use InvalidArgumentException;

readonly class Phone
{
    private const int LENGTH = 8;

    /**
     * @param int $phone
     * @throws InvalidArgumentException
     */
    public function __construct(public int $phone)
    {
        $length = strlen((string)$phone);
        if ($length === 0 || $length > self::LENGTH) {
            throw new InvalidArgumentException("Invalid phone number. Must be from 1 to " . self::LENGTH . " digits long.");
        }
    }

    public function __toString(): string
    {
        return (string)$this->phone;
    }
}
