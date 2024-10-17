<?php

namespace App\Controller;

use App\Entity\ClientEntity;
use App\Form\ClientType;
use App\Repository\ClientEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/client', name: 'client.index', methods:['GET'])]
    public function index(Request $request, ClientEntityRepository $clientRepository): Response
    {
        $page = $request->query->getInt('page', 1);
        $count = 0;
        $totalPages = 0;
        $limit = 3;
        $clients = $clientRepository->paginateClients($page, $limit);
        $count = $clients->count();
        $totalPages = ceil($count/$limit);
        return $this->render('client/index.html.twig', [
            'clients' => $clients,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }

    //Utilisation des path variables
    #[Route('/client/show/{id?}', name: 'client.show', methods:['GET'])]
    public function show(int $id): Response
    {      
        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }

    //Utilisation des Query params
    #[Route('/client/search/tel', name: 'client.searchClientByTel', methods:['GET'])]
    public function searchClientByTel(Request $request, ClientEntityRepository $clientRepository): Response
    {
        $page = $request->query->getInt('page', 1);
        $count = 0;
        $totalPages = 0;
        $limit = 3;
        $tel = $request->query->get('searchPhone');

        if ($tel) {
            $clients = $clientRepository->findBy(['telephone' => $tel]);
            $totalClients = count($clients);
        } else {
            $clients = $clientRepository->paginateClients($page, $limit);
            $count = $clients->count();
            $totalPages = ceil($count/$limit);
        }
        return $this->render('client/index.html.twig', [
            'clients' => $clients,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'searchPhone' => $tel,
        ]);
    }

    #[Route('/client/store', name: 'client.store', methods:['GET', 'POST'])]
    public function store(EntityManagerInterface $entityManager, Request $request): Response
    {
        $client = new ClientEntity();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $client->setCreateAt(new \DateTimeImmutable()); 
            // $client->setUpdateAt(new \DateTimeImmutable()); 
            $entityManager->persist($client);
            $entityManager->flush();
            return $this->redirectToRoute('client.index');
        }
        return $this->render('client/form.html.twig', [
            'formClient' => $form->createView(),
        ]);
    }

    #[Route('/client/remove/{id?}', name: 'client.remove', methods:['GET'])]
    public function remove(int $id, ClientEntity $client, EntityManagerInterface $entityManager): Response
    {      
        // Supprimer le client
        $entityManager->remove($client);
        $entityManager->flush();

        // Redirection après suppression
        $this->addFlash('success', 'Client supprimé avec succès.');
        return $this->redirectToRoute('client.index');
        // return $this->render('client/index.html.twig', [
        //     'controller_name' => 'ClientController',
        // ]);
    }

    #[Route('/client/{id}/dettes', name: 'client.dettes')]
    public function listDettes(ClientEntity $client): Response
    {
        // Récupérer les dettes liées au client
        $dettes = $client->getDettes();

        // Afficher les dettes dans une vue Twig
        return $this->render('client/dette.client.html.twig', [
            'client' => $client,
            'dettes' => $dettes,
        ]);
    }
}

