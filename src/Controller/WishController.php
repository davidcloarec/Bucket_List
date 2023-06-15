<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Formatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
//    private $wishes = [
//        1 => "Faire du Java",
//        2 => "Rencontrer Chuck norris",
//        3 => "Arreter de rever de Java",
//        4 => "Faire un kahoot"
//    ];


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

    #[Route('/ajouter', name: 'add', methods: 'GET')]
    public function add(): Response
    {
        return $this->render('wish/add.html.twig');
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
