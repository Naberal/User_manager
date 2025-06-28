<?php

declare(strict_types=1);

namespace App\User\Infrastructure;

use App\User\Application\API\UserCreator;
use App\User\Application\API\UserLoader;
use App\User\Application\API\UserRemover;
use App\User\Application\API\UserUpdater;
use App\User\Domain\VO\Login;
use App\User\Domain\VO\Password;
use App\User\Domain\VO\Phone;
use App\User\Domain\VO\UserId;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Throwable;

#[Route('/v1/api', name: 'api_')]
class UserController extends AbstractController
{
    #[Route('/users', name: 'user_create', methods: ['POST'])]
    public function create(UserCreator $creator, Request $request): Response
    {
        try {
            $user = $creator->create(
                new Login($request->getPayload()->get('login')),
                new Password($request->getPayload()->get('password')),
                new Phone($request->getPayload()->get('phone'))
            );
            return $this->json($user);
        } catch (Exception $e) {
            return $this->getBadRequestResponse($e);
        } catch (Throwable) {
            return $this->getErrorResponse();
        }
    }

    #[Route('/users/{id}', name: 'user_delete', requirements: ['id' => '\w{8}'], methods: ['DELETE'])]
    public function delete(UserRemover $remover, string $id): Response
    {
        try {
            $remover->remove(new UserId($id));
            return $this->json(null, Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {
            return $this->getBadRequestResponse($e);
        }
    }

    #[Route('/users/{id}', name: 'user_get', requirements: ['id' => '\w{8}'], methods: ['GET'])]
    public function get(UserLoader $loader, string $id): Response
    {
        try {
            $user = $loader->loadById(new UserId($id));
            if ($user === null) {
                return $this->json(null, Response::HTTP_NOT_FOUND);
            }
            return $this->json($user);
        } catch (Exception $e) {
            return $this->getBadRequestResponse($e);
        }
    }

    #[Route('/users/{id}', name: 'user_update', requirements: ['id' => '\w{8}'], methods: ['PUT'])]
    public function update(UserUpdater $updater, UserLoader $loader, Request $request, string $id): Response
    {
        try {
            $updater->update(
                new UserId($id),
                new Login($request->getPayload()->get('login')),
                new Password($request->getPayload()->get('password')),
                new Phone($request->getPayload()->get('phone'))
            );
            $user = $loader->loadById(new UserId($id));
            return $this->json($user);
        } catch (Exception $e) {
            return $this->getBadRequestResponse($e);
        } catch (Throwable) {
            return $this->getErrorResponse();
        }
    }

    private function getBadRequestResponse(Exception $e): JsonResponse
    {
        return $this->json(["error_message" => $e->getMessage()], Response::HTTP_BAD_REQUEST);
    }

    private function getErrorResponse(): JsonResponse
    {
        return $this->json(["error_message" => "Unexpected error"], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
