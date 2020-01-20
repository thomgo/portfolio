<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProjectRepository;

class FrontController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(ProjectRepository $projectRepo)
    {
        $projects = $projectRepo->findBy([], ["position" => "ASC"]);
        return $this->render('front/index.html.twig', [
          "projects" => $projects
        ]);
    }

    /**
     * @Route("/apropos", name="about")
     */
    public function about()
    {
        $title = "coucou les loulous";
        return $this->render('front/about.html.twig', [

        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        $title = "coucou les loulous";
        return $this->render('front/contact.html.twig', [

        ]);
    }
}
