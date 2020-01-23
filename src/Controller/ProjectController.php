<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

/**
 * @Route("/project")
 */
class ProjectController extends AbstractController
{
    /**
     * @Route("/", name="project_index", methods={"GET"})
     */
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $projectRepository->findBy([], ["position" => "ASC"]),
        ]);
    }

    /**
     * @Route("/new", name="project_new", methods={"GET","POST"})
     */
    public function new(Request $request, ProjectRepository $projectRepository, FileUploader $fileUploader): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $imageFilename = $fileUploader->upload($imageFile);
                if ($imageFilename) {
                  $project->setimageFilename($imageFilename);
                }
                else {
                  $this->addFlash('info', "L'enregistrement de l'image a échoué");
                }
              }
            $lastPosition = $projectRepository->getLastPosition();
            $project->setPosition($lastPosition + 1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/new.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="project_show", methods={"GET"})
     */
    public function show(Project $project): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $project,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="project_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Project $project, FileUploader $fileUploader, Filesystem $filesystem): Response
    {
        // $project->setImageFilename(
        //   new File($this->getParameter('projects_images_directory').$project->getImageFilename())
        // );
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
              $imageFilename = $fileUploader->upload($imageFile);
              if ($imageFilename) {
                $filesystem->remove($this->getParameter('projects_images_directory') . $project->getImageFilename());
                $project->setimageFilename($imageFilename);
              }
              else {
                $this->addFlash('info', "La modification de l'image a échoué");
              }
            }
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('project_index');
        }

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="project_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Project $project, Filesystem $filesystem): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->request->get('_token'))) {
            $filesystem->remove($this->getParameter('projects_images_directory') . $project->getImageFilename());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($project);
            $entityManager->flush();
        }

        return $this->redirectToRoute('project_index');
    }

    /**
     * @Route("/{id}", name="project_position", methods={"POST"})
     */
    public function change_position(Request $request, Project $project, ProjectRepository $projectRepository): Response
    {
        if ($this->isCsrfTokenValid('position'.$project->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $totalProjects = $projectRepository->getNumberProjects();
            if ($request->request->get('direction') === "up" && $project->getPosition() > 1) {
              $previousProject = $projectRepository->findOneBy(["position" => $project->getPosition() - 1]);
              $previousProject->setPosition($previousProject->getPosition() + 1);
              $project->setPosition($project->getPosition() - 1);
            }
            elseif ($request->request->get('direction') === "down" && $project->getPosition() < $totalProjects) {
              $nextProject = $projectRepository->findOneBy(["position" => $project->getPosition() + 1]);
              $nextProject->setPosition($nextProject->getPosition() - 1);
              $project->setPosition($project->getPosition() + 1);
            }
            $entityManager->flush();
        }
        return $this->redirectToRoute('project_index');
    }
}
