<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $title = "coucou les loulous";
        return $this->render('front/index.html.twig', [
            'title' => $title,
        ]);
    }
}
