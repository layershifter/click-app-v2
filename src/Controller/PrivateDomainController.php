<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class PrivateDomainController extends Controller
{
    /**
     * @Route("/domain", name="private_domain")
     */
    public function index()
    {
        return $this->render('private_domain/index.html.twig', [
            'controller_name' => 'PrivateDomainController',
        ]);
    }
}
