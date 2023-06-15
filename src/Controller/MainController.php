<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('', name: 'main_')]
class MainController extends AbstractController
{
    #[Route('/', name:'home')]
    public function home() : Response
    {
        return $this->render('main/home.html.twig');
    }

    #[Route('/about-us', name:'about')]
    public function about() : Response
    {


        return $this->render('main/about.html.twig');
    }

    #[Route('/road-to-dql', name: 'roadToDQL')]
    public function roadToDQL(AnimalRepository $repo){
//        $animal = new Animal();
//        $animal->setName('toto');
//        $entityManager->persist($animal);
//        $entityManager->flush();
//        $animals = $repo->findAll();
//        $animal = $repo->findOneBy(['name' => 'toto']);
//        $animals = $repo->findByName('toto');

        return $this->render('main/road.html.twig');
    }

}
