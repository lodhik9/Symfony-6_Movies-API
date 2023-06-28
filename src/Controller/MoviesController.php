<?php

namespace App\Controller;

use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $em;
    private $movieRepository;#
    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }


    // public function __construct(EntityManagerInterface $em)
    // {
    //     $this->em = $em;
    // }



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


    // #[Route('/movies/{id}',methods: ['GET'], name: 'movies')]
    // public function index(MovieRepository $movieRepository): Response
    // {
    //     // $movies = $movieRepository->findAll();
    //     // dd($movies);
    //     $movies = $this->movieRepository->findAll();
    //     // dd($movies);

    //     return $this->render('movies/index.html.twig', [
    //         'movies' => $movies
    //     ]);

    #[Route('/movies',methods: ['GET'], name: 'movies')]
    public function index(): Response
    {
        // $movies = $movieRepository->findAll();
        // dd($movies);
        $movies = $this->movieRepository->findAll();
        // dd($movies);

        return $this->render('movies/index.html.twig', [
            'movies' => $movies
        ]);
    }

    #[Route('/movies/create', name: 'create_movie')]
    public function create(): Response
    {
        $movie = new Movie();
        $form = this->createForm(MovieFormType::class, $movie);

        return $this->render('/movies/create.html.twg', [
            'form'=> $form->createView()
        ]);


    }

        #[Route('/movies/{id}',methods: ['GET'], name: 'movies')]
         public function show($id): Response
    {
        // $movies = $movieRepository->findAll();
        // dd($movies);
        $movie = $this->movieRepository->find($id);
        // dd($movies);

        return $this->render('movies/show.html.twig', [
            'movies' => $movie
        ]);
    }

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