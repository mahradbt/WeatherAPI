<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var JWTTokenManagerInterface
     */
    private JWTTokenManagerInterface $jwtManager;
    /**
     * @var ValidatorInterface
     */
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator,
                                UserRepository $userRepository,
                                JWTTokenManagerInterface $jwtManager)
    {
        $this->validator = $validator;
        $this->userRepository = $userRepository;
        $this->jwtManager = $jwtManager;
    }

    /**
     * @Route("/api/register", name="api_register", methods={"POST"})
     * @param Request $request
     * @param UserPasswordHasherInterface $passwordHasher
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher,
                             EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);
        if ($this->userRepository->findByEmail($data['email'])) {
            return new Response('User already registered', Response::HTTP_BAD_REQUEST);
        }
        $user = new User();
        $user->setEmail($data['email']);

        // Encode the password
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $data['password']
        );
        $user->setPassword($hashedPassword);
        $this->validator->validate($user);
        // Persist the user to the database
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('User registered successfully', Response::HTTP_CREATED);
    }

    public function login(Request $request): Response
    {
        $credentials = json_decode($request->getContent(), true);
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user) {
            throw new BadCredentialsException('Invalid username or password');
        }
        // Check password
        if (!password_verify($credentials['password'], $user->getPassword())) {
            throw new BadCredentialsException('Invalid username or password');
        }

        //  Generate JWT token
        $token = $this->jwtManager->create($user);

        return new JsonResponse(['token' => $token]);
    }

}
