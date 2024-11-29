<?php

namespace App\Controller;

use App\Entity\Mark;
use App\Entity\Produits;
use App\Form\MarkType;
use App\Form\ProduitsType;
use App\Repository\MarkRepository;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Cache\ItemInterface;

class ProduitsController extends AbstractController
{
    #[Route('/produit', name: 'app.produits', methods: ['GET'])]
    public function index(Produits $produits, PaginatorInterface $paginator, Request $request): Response
    {
       
        return $this->render('produits/index.html.twig', [
            'produits' => $produits
        ]);
    }
    #[Route('/produit/nouveau', name: 'produits.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {

        $produits = new Produits();
        $form = $this->createForm(ProduitsType::class, $produits);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $produits = $form->getData();

            $entityManager->persist($produits);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre produit a été ajouté avec succès !'
            );
            return $this->redirectToRoute('app.produits');
        }
        return $this->render('produits/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/produits/edition/{id}', name: 'produits.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProduitsRepository $repository, EntityManagerInterface $entityManager, int $id): Response
    {
        // Récupérer l'entité existante
        $produits = $repository->findOneBy(["id" => $id]);

        // Si l'entité n'est pas trouvée, renvoyer une erreur 404
        if (!$produits) {
            throw $this->createNotFoundException('Le produit demandé n\'existe pas.');
        }

       

        $form = $this->createForm(ProduitsType::class, $produits);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $produits = $form->getData();

            $entityManager->persist($produits);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre produit a été mis à jour avec succès !'
            );

            return $this->redirectToRoute('app.produits');
        }

        return $this->render('produits/edit.html.twig', [
            'form' => $form->createView(),
            'produits' => $produits
        ]);
    }

    #[Route('/produits/suppression/{id}', name: 'produits.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Produits $produits): Response
    {
        $manager->remove($produits);
        $manager->flush();
        
        $this->addFlash(
            'success',
            'Votre produit a été supprimé avec succès !'
        );

        return $this->redirectToRoute('produits.index');
    }


    #[Route('/produits/{id}', 'produits.show', methods: ['GET', 'POST'])]
    public function show(
        Produits $produits, Request $request, EntityManagerInterface $manager, MarkRepository $markRepository): Response {

        $mark = new Mark();
        $form = $this->createForm(MarkType::class, $mark);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mark->setUser($this->getUser())
            ->setflat($produits);

            $existingMark = $markRepository->findOneBy([
                'user' => $this->getUser(),
                'produits' => $produits
            ]);
            if(!$existingMark) {
                $manager->persist($mark);
            } else {
                $existingMark->setMark(
                    $form->getData()->getMark()
                );
            }

            $manager->flush();

            $this->addFlash(
                'success',
                'Votre note a bien été prise en compte.'
            );

            return $this->redirectToRoute('produits.show', ['id' => $produits->getId()]);
        }
        return $this->render('produits/show.html.twig', [
            'produits' => $produits,
            'form' => $form->createView()
        ]);
    }
}

