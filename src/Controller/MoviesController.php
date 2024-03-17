<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\CommentVote;
use App\Entity\Movie;
use App\Entity\ReviewLike;
use App\Form\CommentType;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\Date;

class MoviesController extends AbstractController
{
    private $movieRepository;
    private $em;
    private $slugger;
    public function __construct(SluggerInterface $slugger, MovieRepository $movieRepository, EntityManagerInterface $em)
    {
        $this->movieRepository = $movieRepository;
        $this->em = $em;
        $this->slugger = $slugger;
    }

    #[Route('/', name: 'homepage')]
    public function homepage()
    {
        return $this->redirectToRoute('movies');
    }

    #[Route('/movies', methods: ['GET'], name: 'movies')]
    public function index(): Response
    {   
        $movies = $this->movieRepository->findAll();

        return $this->render('movies/index.html.twig', ['movies' => $movies]);
    }

    #[Route('/movies/create', name: 'create_movie')]
public function create(Request $request, SluggerInterface $slugger): Response
{
    $movie = new Movie();
    $form = $this->createForm(MovieFormType::class, $movie);        
    
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        
        $slug = $slugger->slug($form->get('title')->getData())->lower()->toString();
        $newMovie = $form->getData();
        $newMovie->setPublishDate(new \DateTimeImmutable());
        $newMovie->setSlug($slug);
        $newMovie->setReviwer($this->getUser());
        $imagePath = $form->get('imagePath')->getData();
        if ($imagePath) {
            $newFileName = uniqid() . '.' . $imagePath->guessExtension();

            try {
                $imagePath->move(
                    $this->getParameter('kernel.project_dir') . '/public/uploads',
                    $newFileName
                );
            } catch (FileException $e) {
                return new Response($e->getMessage());
            }

            $newMovie->setImagePath('/uploads/' . $newFileName);
            $this->em->persist($newMovie);
            $this->em->flush();
        }

        return $this->redirectToRoute('movies');
    }

    return $this->render('movies/create.html.twig', [
        'form' => $form->createView(),
    ]);
}

    #[Route('/movie/edit/{id}', name: 'edit_movie')]
    public function edit($id, Request $request): Response 
    {
        $movie = $this->movieRepository->find($id);

        $form = $this->createForm(MovieFormType::class, $movie);

        $form->handleRequest($request);
        $imagePath = $form->get('imagePath')->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            if ($imagePath) {
                if ($movie->getImagePath() !== null) {
                    if (file_exists(
                        $this->getParameter('kernel.project_dir') . $movie->getImagePath()
                        )) {
                            $this->GetParameter('kernel.project_dir') . $movie->getImagePath();
                    }
                    $newFileName = uniqid() . '.' . $imagePath->guessExtension();

                    try {
                        $imagePath->move(
                            $this->getParameter('kernel.project_dir') . '/public/uploads',
                            $newFileName
                        );
                    } catch (FileException $e) {
                        return new Response($e->getMessage());
                    }

                    $movie->setImagePath('/uploads/' . $newFileName);
                    $this->em->flush();

                    return $this->redirectToRoute('movies');
                }
            } else {
                $slug = $this->slugger->slug($form->get('title')->getData())->lower()->toString();
                $movie->setSlug($slug);
                $movie->setTitle($form->get('title')->getData());
                $movie->setReleaseYear($form->get('releaseYear')->getData());
                $movie->setDescription($form->get('description')->getData());

                $this->em->flush();
                return $this->redirectToRoute('movie', ['slug' => $movie->getSlug()]);
            }
        }

        return $this->render('movies/edit.html.twig', [
            'movie' => $movie,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/movie/delete/{id}', methods: ['GET', 'DELETE'], name: 'delete_movie')]
    public function delete($id): Response
    {
        $movie = $this->movieRepository->find($id);
        $this->em->remove($movie);
        $this->em->flush();

        return $this->redirectToRoute('movies');
    }

    #[Route('/movie/{slug}', methods: ['GET', 'POST'], name: 'movie')]
    public function show(Request $request, PaginatorInterface $paginator, $slug): Response
    {   
        $movie = $this->movieRepository->findOneBy(['slug' => $slug]);
        if (!$movie) {
            throw $this->createNotFoundException('Movie not found');
        }

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($this->getUser());
            $comment->setMovie($movie);
            $comment->setCreatedAt(new DateTimeImmutable());
            $this->em->persist($comment);
            $this->em->flush();
            
            return $this->redirectToRoute('movie', ['slug' => $movie->getSlug()]);
        }
        

        $commentsQuery = $this->em
        ->getRepository(Comment::class)
        ->createQueryBuilder('c')
        ->leftJoin('c.commentVotes', 'cv')
        ->addSelect('COUNT(cv.id) AS upvoteCount') 
        ->where('c.movie = :movie')
        ->setParameter('movie', $movie)
        ->groupBy('c.id') 
        ->orderBy('upvoteCount', 'DESC') 
        ->addOrderBy('c.created_at', 'DESC')
        ->getQuery()
        ->getResult();

        $pagination = $paginator->paginate(
            $commentsQuery,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('movies/show.html.twig', ['movie' => $movie, 'commentForm' => $form->createView(), 'pagination' => $pagination]);
    }

    #[Route('/movie/like/{id}', methods: ["GET"], name: 'movie_like')]
    public function like(Movie $movie): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $existingVote = $this->em
            ->getRepository(ReviewLike::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'movie' => $movie,
            ]);

        if ($existingVote) {
            return $this->redirectToRoute('movie', ['slug' => $movie->getSlug()]);
        }

        $like = new ReviewLike();
        $like->setUser($this->getUser());
        $like->setMovie($movie);

        $this->em->persist($like);
        $this->em->flush();

        return $this->redirectToRoute('movie', ['slug' => $movie->getSlug()]);
    }

    #[Route('/movie/unlike/{reviewLike}', methods: ["GET"], name: 'movie_unlike')]
    public function unlike(ReviewLike $reviewLike): Response
    {
        $this->em->remove($reviewLike);
        $this->em->flush();


        return $this->redirectToRoute('movie', ['slug' => $reviewLike->getMovie()->getSlug()]);
    }

    #[Route('/search', name: 'search_movies', methods: ['GET'])]
    public function searchMovies(Request $request): Response
    {
        $query = $request->query->get('query');

        // Assuming findByTitle is a custom method in your MovieRepository
        $movies = $this->em->getRepository(Movie::class)->createQueryBuilder('m')
        ->where('m.title LIKE :query')
        ->setParameter('query','%'.$query.'%')
        ->getQuery()
        ->getResult();

        return $this->render('movies/_search_results.html.twig', [
            'movies' => $movies,
        ]);
    }
}
