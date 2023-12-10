<?php

namespace App\Controller;

use App\Repository\SeasonRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Form\ProgramType;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Doctrine\ORM\EntityManagerInterface;


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
    public function new(Request $request, EntityManagerInterface $entityManager) : Response
{
    // Create a new Category Object
    $program = new Program();
    // Create the associated Form
    $form = $this->createForm(ProgramType::class, $program);
    // Get data from HTTP request
    $form->handleRequest($request);
    // Was the form submitted ?
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager->persist($program);
        $entityManager->flush(); 
        return $this->redirectToRoute('program_index');
        // Deal with the submitted data
        // For example : persiste & flush the entity
        // And redirect to a route that display the result
    }

    // Render the form
    return $this->render('program/new.html.twig', [
        'form' => $form,
    ]);
}

    #[Route('/program/{id}/', name: 'show')]
public function show(Program $program): Response
{
  return $this->render('program/show.html.twig', ['program'=>$program]);
}


    #[Route('/program/{programId}/seasons/{seasonId}', name: 'season_show')]
    public function showSeason(
        #[MapEntity(mapping: ['programId' => 'id'])] Program $program,
        #[MapEntity(mapping: ['seasonId' => 'id'])] Season $season,): Response
    {
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }

    #[Route('/program/{programId}/seasons/{seasonId/episode/{episodeId}', name: 'episode_show')]
    public function showEpisode(
        #[MapEntity(mapping: ['programId' => 'id'])] Program $program,
        #[MapEntity(mapping: ['seasonId' => 'id'])] Season $season,
        #[MapEntity(mapping: ['episodeId' => 'id'])] Episode $episode,): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' =>$episode
        ]);
    }

    /* #[Route('/show/{programId}/seasons/{seasonId}', name: 'season_show', requirements: ['programId'=>'\d+', 'seasonId'=>'\d+'], methods: ['GET'])]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $programId]);
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);

    } */
}