<?php

namespace App\Controller;

use App\Entity\DetteEntity;
use App\Form\DetteType;
use App\Repository\DetteEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class DetteController extends AbstractController
{
    #[Route('/dettes', name: 'dette.index', methods:['GET'])]
    public function index(EntityManagerInterface $entityManager, Request $request, DetteEntityRepository $detteRepository): Response
    {
        //Pour la pagination
        $limit = 3;
        $page = $request->query->getInt('page', 1);
        $offset = ($page - 1) * $limit;
        $dettes = $detteRepository->findBy([], null, $limit, $offset);
        $totalClients = $detteRepository->count([]);
        $totalPages = ceil($totalClients / $limit);
        $clients = $entityManager->getRepository(DetteEntity::class)->findAll();
        
        return $this->render('dette/index.html.twig', [
            'dettes' => $dettes,
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ]);
    }
}
