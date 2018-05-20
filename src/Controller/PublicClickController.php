<?php

namespace App\Controller;

use App\Exception\DoubleClickException;
use App\Factory\ClickDtoFactoryInterface;
use App\Service\ClickServiceInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class PublicClickController extends Controller
{
    /**
     * @var ClickDtoFactoryInterface
     */
    private $clickDtoFactory;
    /**
     * @var ClickServiceInterface
     */
    private $clickService;

    public function __construct(ClickDtoFactoryInterface $clickDtoFactory, ClickServiceInterface $clickHandlerService)
    {
        $this->clickDtoFactory = $clickDtoFactory;
        $this->clickService = $clickHandlerService;
    }

    /**
     * @Route("/error/{id}")
     *
     * @param string $id
     * @return Response
     */
    public function error(string $id): Response
    {
        $click = $this->clickService->getClickById($id);

        return $this->render('public_click/error.html.twig', compact('click'));
    }

    /**
     * @Route("/click/")
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $clickDto = $this->clickDtoFactory->createFromRequest($request);

        try {
            $this->clickService->handleClick($clickDto);
        } catch (DoubleClickException $e) {
            return new RedirectResponse(sprintf('/error/%s', $clickDto->getId()));
        }

        return new RedirectResponse(sprintf('/success/%s', $clickDto->getId()));
    }

    /**
     * @Route("/success/{id}")
     *
     * @param string $id
     * @return Response
     */
    public function success(string $id): Response
    {
        $click = $this->clickService->getClickById($id);

        return $this->render('public_click/success.html.twig', compact('click'));
    }
}
