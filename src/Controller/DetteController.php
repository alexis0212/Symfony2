<?php

namespace App\Controller;

use App\Entity\Dette;
use App\Entity\Client;
use App\Repository\DetteRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DetteController extends AbstractController
{
    #[Route('/clients/{id}/dettes', name: 'client_dettes')]
    public function index(
        Client $client,
        DetteRepository $detteRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $filter = $request->query->get('status');
        $query = $detteRepository->findByStatus($client, $filter);

        $detteList = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('dette/index.html.twig', [
            'client' => $client,
            'detteList' => $detteList,
        ]);
    }
}
