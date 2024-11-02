<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/clients', name: 'client_index')]
    public function index(
        Request $request,
        ClientRepository $clientRepository,
        PaginatorInterface $paginator
    ): Response {
        $query = $clientRepository->searchByFilters(
            $request->query->get('telephone'),
            $request->query->get('surname')
        );

        $clients = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('client/index.html.twig', [
            'clients' => $clients,
        ]);
    }

    #[Route('/clients/create', name: 'client_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/clients/{id}/dettes', name: 'client_dettes')]
    public function showDettes(Client $client): Response
    {
        return $this->render('client/dettes.html.twig', [
            'client' => $client,
        ]);
    }

    #[Route('/clients/{id}/delete', name: 'client_delete')]
    public function delete(Client $client, EntityManagerInterface $em): Response
    {
        $em->remove($client);
        $em->flush();

        return $this->redirectToRoute('client_index');
    }

    
}
