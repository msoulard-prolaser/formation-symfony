<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use function PHPUnit\Framework\throwException;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_security_login')]
    public function login(AuthenticationUtils $utils): Response
    {
        $lastUsername =  $utils->getLastUsername();
        $error = $utils->getLastAuthenticationError();

        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_security_logout')]
    public function logout()
    {
    }
}
