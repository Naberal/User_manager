<?php
declare(strict_types=1);

namespace App\User\Infrastructure\DB\DoctrineTypes;

use App\User\Domain\VO\Password;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use InvalidArgumentException;

class PasswordType extends StringType
{
    public const string NAME = 'password';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Password ? $value->password : $value;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Password
    {
        return $value !== null ? new Password($value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
