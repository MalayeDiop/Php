<?php

namespace App\Controller;

use App\Form\ArticleType;
use App\Entity\ArticleEntity;  
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ArticleEntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'article.index', methods:['GET'])]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $articles = $entityManager->getRepository(ArticleEntity::class)->findAll();
        
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/article/store', name: 'article.store', methods:['GET', 'POST'])]
    public function store(EntityManagerInterface $entityManager, Request $request): Response
    {
        $article = new ArticleEntity();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('article.index');
        }
        return $this->render('article/form.html.twig', [
            'formArticle' => $form->createView(),
        ]);
    }

    #[Route('/article/search/libelle', name: 'article.searchArticle', methods:['GET'])]
    public function searchArticle(Request $request, ArticleEntityRepository $articleRepository): Response
    {
        $libelle = $request->query->get('searchArt');
        if ($libelle) {
            $articles = $articleRepository->findBy(['libelle' => $libelle]);
        }
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
