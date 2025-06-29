<?php
declare(strict_types=1);

namespace App\User\Infrastructure;

use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\AccessToken\AccessTokenHandlerInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class AccessTokenHandler implements AccessTokenHandlerInterface
{

    /**
     * @inheritDoc
     */
    public function getUserBadgeFrom(#[\SensitiveParameter] string $accessToken): UserBadge
    {
        if (!in_array($accessToken, ['testAdmin', 'testUser'])) {
            throw new AuthenticationException('Invalid token');
        }
        return new UserBadge($accessToken);
    }
}
