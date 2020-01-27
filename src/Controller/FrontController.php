<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        return $this->render('front/about.html.twig', []);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        }
        return $this->render('front/contact.html.twig', [
          "form" => $form->createView()
        ]);
    }
}
