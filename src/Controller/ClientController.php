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
    public function index(EntityManagerInterface $entityManager, Request $request, ClientEntityRepository $clientRepository): Response
    {
        // Paramètres pour la pagination
        $limit = 3;
        $page = $request->query->getInt('page', 1);
        $offset = ($page - 1) * $limit;
        $clients = $clientRepository->findBy([], null, $limit, $offset);
        $totalClients = $clientRepository->count([]);
        $totalPages = ceil($totalClients / $limit);
        $clients = $entityManager->getRepository(ClientEntity::class)->findAll();
        
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
    public function searchClientByTel(EntityManagerInterface $entityManager, Request $request, ClientEntityRepository $clientRepository): Response
    {
        $limit = 10; // Nombre de clients par page
        $page = $request->query->getInt('page', 1); // Page actuelle
        $offset = ($page - 1) * $limit; // Calcul de l'offset
        // $tel = $request->query->get('tel');
        $tel = $request->query->get('searchPhone');

        if ($tel) {
            // Si une recherche par téléphone est effectuée
            $clients = $clientRepository->findBy(['telephone' => $tel], null, $limit, $offset);
            $totalClients = count($clients);
        } else {
            // Sinon, récupération de tous les clients
            $clients = $clientRepository->findBy([], null, $limit, $offset);
            $totalClients = $clientRepository->count([]);
        }
        $totalPages = ceil($totalClients / $limit);
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
        if ($form->isSubmitted()) {
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
}

