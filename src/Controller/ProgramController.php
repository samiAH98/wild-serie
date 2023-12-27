<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Form\ProgramType;
use App\Service\ProgramDuration;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer, SluggerInterface $slugger) : Response
{
    // Create a new Category Object
    $program = new Program();
    // Create the associated Form
    $form = $this->createForm(ProgramType::class, $program);
    // Get data from HTTP request
    $form->handleRequest($request);
    // Was the form submitted ?
    if ($form->isSubmitted() && $form->isValid()) {
        $slug = $slugger->slug($program->getTitle());
        $program->setSlug($slug);
        $entityManager->persist($program);
        $entityManager->flush();

        $this->addFlash('success', 'Le programme a été ajouté avec succès.');

        #$email = (new Email())
           # ->from($this->getParameter('mailer_from'))
            #->to('sami.ahamadi@laposte.net')
           # ->subject('Une nouvelle série vient d\'être publiée !')
            #->html($this->renderView('Program/newProgramEmail.html.twig', ['program' => $program]));

        #$mailer->send($email);
        // Deal with the submitted data
        // For example : persiste & flush the entity
        // And redirect to a route that display the result
        return $this->redirectToRoute('program_index');
    }

    // Render the form
    return $this->render('program/new.html.twig', [
        'form' => $form,
    ]);
}

  #[Route('/{slug}', name: 'show')]
public function show(Program $program, ProgramDuration $programDuration): Response
{
    $duration = $programDuration->calculate($program);
    return $this->render('program/show.html.twig', [
        'program' => $program, 
        'duration' => $duration
    ]);
}


#[Route('/{slug}/season/{id}', name: 'season_show')]
public function showSeason(string $slug, ProgramRepository $programRepository, Season $season): Response
{   
    $program = $programRepository->findOneBy(['slug' => $slug]);
    return $this->render('program/season_show.html.twig', [
        'program' => $program,
        'season' => $season,
    ]);
}

#[Route('/{slug}/season/{seasonId}/episode/{episodeId}', name: 'episode_show')]
public function showEpisode(Program $program, Season $season, Episode $episode): Response
{
    //slug = $slugger->slug($program->getTitle());
    //$program->setSlug($slug);
    //$episode->setSlug($slug);
    return $this->render('program/episode_show.html.twig', [
        'program' => $program,
        'season' => $season,
        'episode' => $episode,
    ]);
}

    #[Route('/edit/{slug}', name: 'edit')]
    public function edit(string $slug, Request $request, ProgramRepository $programRepository, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $program = $programRepository->findOneBy(['slug' => $slug]);
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);
            $entityManager->flush();
            $this->addFlash('success', 'Le programme a été modifié avec succès.');

            return $this->redirectToRoute('program_index');
        }

        return $this->render('program/edit.html.twig', [
            'program' => $program,
            'form' => $form,
        ]);
    }

     #[Route('/delete/{slug}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Program $program, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        if ($this->isCsrfTokenValid('delete'.$program->getId(), $request->request->get('_token'))) {
            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);
            $entityManager->remove($program);
            $entityManager->flush();

            $this->addFlash('danger', 'Le programme a été supprimé.');

            return $this->redirectToRoute('program_index');
        }

        return $this->redirectToRoute('program_index');
    } 
    
}