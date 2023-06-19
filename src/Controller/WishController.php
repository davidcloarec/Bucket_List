<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('/list', name: 'list')]
    public function list(WishRepository $wishRepository): Response
    {
        $wishes = $wishRepository->findBy([],['dateCreated'=>'DESC']);
        return $this->render('wish/list.html.twig',[
            'wishes' => $wishes
        ]);
    }

    #[Route('/detail/{id}', name: 'detail', requirements: ['id' => '\d+'])]
    public function detail($id, WishRepository $wishRepository): Response
    {
        $wish = $wishRepository->find($id);
        return $this->render('wish/detail.html.twig',[
            'wish' => $wish
        ]);
    }

    #[Route('/ajout', name: 'add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $wish = new Wish();
        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);
        if($wishForm->isSubmitted() && $wishForm->isValid()){
            $wish->setIsPublished(true);
            $wish->setDateCreated(new \DateTime());

            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success','Idée ajoutée !');
            return $this->redirectToRoute('wish_detail', ['id'=>$wish->getId()]);
        }

        return $this->render('wish/add.html.twig',[
            'wishForm' => $wishForm->createView()
        ]);
    }








    #[Route('/ajouter', name: 'addOld', methods: 'GET')]
    public function addOld(): Response
    {
        return $this->render('wish/addOld.html.twig');
    }

    #[Route('/ajouter', name: 'addPost', methods: 'POST')]
    public function addPost(EntityManagerInterface $entityManager): Response
    {
        $wish = new Wish();
        $wish->setTitle($_POST['title']);
        $wish->setDescription($_POST['description']);
        $wish->setAuthor($_POST['author']);
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());
        $entityManager->persist($wish);
        $entityManager->flush();
        return $this->render('wish/add.html.twig',[
            'ajout'=>'Ajouté'
        ]);
    }
}
