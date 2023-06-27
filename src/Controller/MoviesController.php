<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }



    #[Route('/second', name: 'movies')]
    public function second(): Response
    {
        $movieRepository = $this->em->getRepository(Movie::class);
        $movies = $movieRepository->findAll();

        $movies = $movieRepository->find(5);

        $movies = $movieRepository->findBy([],['id' => 'DESC']);
       
        $movies = $movieRepository->findOneBy(['id' => 5, 'title' => 'Inception'],['id' => 'DESC']);

        dd($movies);

        return $this->render('index.html.twig');
    }

    #[Route('/movies', name: 'movies')]
    public function index(MovieRepository $movieRepository): Response
    {
        $movies = $movieRepository->findAll();

        dd($movies);

        return $this->render('index.html.twig');

        // $movies = ["Avengers: Endgame", "Inception", "Loki"];

        // return $this->render('index.html.twig', array(
        //     'movies' => $movies
        // ));

        // return $this->json([
        //     'message' => $name,
        //     'path' => 'src/Contoller/MoviesController.php'
        // ]);

    }
}