<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Title cannot be blank')]
    #[Assert\Length(max: 60, maxMessage: 'Title cannot be longer than {{ limit }} characters')]
    private ?string $title = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Release year cannot be blank')]
    private ?int $releaseYear = null;

    #[Assert\NotBlank(message: 'Description cannot be blank')]
    #[Assert\Length(max: 5000, maxMessage: 'Description must have less than 5000 letters')]
    #[ORM\Column(length: 5000, nullable: true)]
    private ?string $description = null;

    #[Assert\NotBlank(message: 'You have not selected any image for thumbnail')]
    #[ORM\Column(length: 255)]
    private ?string $imagePath = null;

    #[ORM\ManyToMany(targetEntity: Actor::class, inversedBy: 'movies')]
    private Collection $actors;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $publish_date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $reviwer = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'movie', orphanRemoval: true)]
    private Collection $comments;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'Rating cannot be blank')]
    #[Assert\Range(min: 5, max: 10, notInRangeMessage: 'Rating must be between 5 and 10')]
    private ?int $rating = null;

    #[ORM\OneToMany(targetEntity: ReviewLike::class, mappedBy: 'movie', orphanRemoval: true)]
    private Collection $reviewLikes;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->reviewLikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(int $releaseYear): static
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    /**
     * @return Collection<int, Actor>
     */
    public function getActors(): Collection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): static
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        $this->actors->removeElement($actor);

        return $this;
    }

    public function getPublishDate(): ?\DateTimeInterface
    {
        return $this->publish_date;
    }

    public function setPublishDate(\DateTimeInterface $publish_date): static
    {
        $this->publish_date = $publish_date;

        return $this;
    }

    public function getReviwer(): ?User
    {
        return $this->reviwer;
    }

    public function setReviwer(?User $reviwer): static
    {
        $this->reviwer = $reviwer;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setMovie($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getMovie() === $this) {
                $comment->setMovie(null);
            }
        }

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * @return Collection<int, ReviewLike>
     */
    public function getReviewLikes(): Collection
    {
        return $this->reviewLikes;
    }

    public function addReviewLike(ReviewLike $reviewLike): static
    {
        if (!$this->reviewLikes->contains($reviewLike)) {
            $this->reviewLikes->add($reviewLike);
            $reviewLike->setMovie($this);
        }

        return $this;
    }

    public function removeReviewLike(ReviewLike $reviewLike): static
    {
        if ($this->reviewLikes->removeElement($reviewLike)) {
            // set the owning side to null (unless already changed)
            if ($reviewLike->getMovie() === $this) {
                $reviewLike->setMovie(null);
            }
        }

        return $this;
    }
}
