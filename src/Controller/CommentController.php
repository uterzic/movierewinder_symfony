<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\CommentVote;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommentController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/comment/post', name: 'comment_post', methods: ['POST'])]
    public function index(): Response
    {
        return $this->render('comment/index.html.twig', [
            'controller_name' => 'CommentController',
        ]);
    }

    #[Route('/comment/{id}/upvote', methods: ["POST"], name: 'comment_upvote')]
    public function upvote(Comment $comment): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('movie', ['slug' => $comment->getMovie()->getSlug()]);
        }

        $existingVote = $this->em
            ->getRepository(CommentVote::class)
            ->findOneBy([
                'user' => $this->getUser(),
                'comment' => $comment,
            ]);

        if ($existingVote) {
            return $this->redirectToRoute('movie', ['slug' => $comment->getMovie()->getSlug()]);
        }

        $vote = new CommentVote();
        $vote->setUser($this->getUser());
        $vote->setComment($comment);

        $this->em->persist($vote);
        $this->em->flush();

        return $this->redirectToRoute('movie', ['slug' => $comment->getMovie()->getSlug()]);
    }

    #[Route('/comment/{id}/delete', name: 'comment_delete')]
    public function deleteComment(Comment $comment): Response
    {
        $this->em->remove($comment);
        $this->em->flush();


        return $this->redirectToRoute('movie', ['slug' => $comment->getMovie()->getSlug()]);
    }
}
