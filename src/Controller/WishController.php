<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    private $wishes = [
        1 => "Faire du Java",
        2 => "Rencontrer Chuck norris",
        3 => "Arreter de rever de Java",
        4 => "Faire un kahoot"
    ];


    #[Route('/list', name: 'list')]
    public function list(): Response
    {
        return $this->render('wish/list.html.twig',[
            'wishes' => $this->wishes
        ]);
    }

    #[Route('/detail/{id}', name: 'detail', requirements: ['id' => '\d+'])]
    public function detail($id): Response
    {
        $wish = $this->wishes[$id];
        return $this->render('wish/detail.html.twig',[
            'wish' => $wish
        ]);
    }
}
