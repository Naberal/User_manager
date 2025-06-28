<?php
declare(strict_types=1);

namespace App\User\Infrastructure\DB\DoctrineTypes;

use App\User\Domain\VO\Phone;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use InvalidArgumentException;

class PhoneType extends StringType
{
    public const string NAME = 'phone';

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Phone ? $value->phone : $value;
    }

    /**
     * @throws InvalidArgumentException
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?Phone
    {
        return $value !== null ? new Phone((int)$value) : null;
    }

    public function getName(): string
    {
        return self::NAME;
    }
}
