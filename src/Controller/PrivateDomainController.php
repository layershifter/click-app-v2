<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\EntityNotFoundException;
use App\Factory\BadDomainDtoFactoryInterface;
use App\Service\BadDomainServiceInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

final class PrivateDomainController extends Controller
{
    /**
     * @var BadDomainDtoFactoryInterface
     */
    private $domainDtoFactory;
    /**
     * @var BadDomainServiceInterface
     */
    private $domainService;

    public function __construct(BadDomainDtoFactoryInterface $domainDtoFactory, BadDomainServiceInterface $domainService)
    {
        $this->domainDtoFactory = $domainDtoFactory;
        $this->domainService = $domainService;
    }

    /**
     * @Route("/domain")
     *
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('private_domain/index.html.twig', [
            'domains' => $this->domainService->findAll(),
        ]);
    }

    /**
     * @Route("/domain/add", methods={"GET"})
     *
     * @return Response
     */
    public function add(): Response
    {
        return $this->render('private_domain/add.html.twig');
    }

    /**
     * @Route("/domain/{id}/delete", methods={"POST"})
     *
     * @param int $id
     *
     * @return Response
     */
    public function delete(int $id): Response
    {
        try {
            $domain = $this->domainService->getDomainById($id);
        } catch (EntityNotFoundException $e) {
            return $this->redirect('/domain');
        }

        $this->domainService->deleteDomain($domain);

        return $this->redirect('/domain');
    }

    /**
     * @Route("/domain/add", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request): Response
    {
        $domainDto = $this->domainDtoFactory->createFromRequest($request);
        $this->domainService->addDomain($domainDto);

        return $this->redirect('/domain');
    }
}
