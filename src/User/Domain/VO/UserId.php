<?php
declare(strict_types=1);

namespace App\User\Domain\VO;

use App\Lib\IdGenerator;
use InvalidArgumentException;

readonly class UserId
{
    private const int LENGTH = 8;

    /**
     * @param string $id
     * @throws InvalidArgumentException
     */
    public function __construct(public string $id)
    {
        $trimmedId = trim($id);
        if (strlen($trimmedId) !== strlen($this->id)) {
            throw new InvalidArgumentException('ID contains whitespace');
        }
        if (strlen($trimmedId) !== self::LENGTH) {
            throw new InvalidArgumentException('ID must be ' . self::LENGTH . ' characters long');
        }
    }

    public function __toString(): string
    {
        return $this->id;
    }

    /**
     * @return self
     * @throws InvalidArgumentException
     */
    public static function generate(): self
    {
        return new self(IdGenerator::generate(8));
    }
}
