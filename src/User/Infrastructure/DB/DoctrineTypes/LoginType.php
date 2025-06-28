<?php
declare(strict_types=1);

namespace App\User\Infrastructure\DB\DoctrineTypes;

use App\User\Domain\VO\Login;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use InvalidArgumentException;

class LoginType extends StringType
{
    public const string NAME = 'login';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Login ? $value->login : $value;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Login
    {
        return $value !== null ? new Login($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
