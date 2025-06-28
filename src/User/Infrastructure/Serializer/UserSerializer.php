<?php
declare(strict_types=1);

namespace App\User\Infrastructure\Serializer;

use App\User\Domain\Entities\User;
use InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UserSerializer implements NormalizerInterface
{
    /**
     * @throws InvalidArgumentException
     */
    public function normalize(mixed $data, ?string $format = null, array $context = []): array|string|int|float|bool|\ArrayObject|null
    {
        if (!$data instanceof User) {
            throw new InvalidArgumentException('The object must be an instance of User');
        }

        return [
            'id' => (string)$data->id,
            'login' => (string)$data->getLogin(),
            'phone' => (string)$data->getPhone(),
            'password' => (string)$data->getPassword(),
        ];
    }

    public function supportsNormalization(mixed $data, ?string $format = null, array $context = []): bool
    {
        return $data instanceof User;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [
            User::class => true,
        ];
    }
}
