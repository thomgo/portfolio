<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
    public function contact(Request $request, ValidatorInterface $validator, MailerInterface $mailer)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $errors = $validator->validate($contact);
          if(count($errors) > 0){
            $this->addFlash(
              'errors',
              $errors
            );
          }
          else {
            $email = (new Email())
            ->from($contact->getEmail())
            ->to($this->getParameter('contact_email'))
            ->subject('Prise de contact de ' . $contact->getName())
            ->text($contact->getMessage());
            try {
              $sentEmail = $mailer->send($email);
              $this->addFlash(
                'success',
                'Votre message a bien été envoyé. Je reviendrai vers vous le plus rapidement possible.'
              );
            } catch (\Exception $e) {
              $this->addFlash(
                'danger',
                "Un problème est survenu, votre message n'a pas pu être envoyé. Merci de réessayer."
              );
            }
          }
        }
        return $this->render('front/contact.html.twig', [
          "form" => $form->createView()
        ]);
    }
}
