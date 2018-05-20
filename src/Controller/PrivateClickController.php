<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\ClickServiceInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class PrivateClickController extends Controller
{
    /**
     * @var ClickServiceInterface
     */
    private $clickService;

    public function __construct(ClickServiceInterface $clickService)
    {
        $this->clickService = $clickService;
    }

    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('private_click/index.html.twig', [
            'clicks' => $this->clickService->findAll(),
        ]);
    }
}
