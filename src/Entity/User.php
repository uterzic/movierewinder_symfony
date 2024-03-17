<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_USERNAME', fields: ['username'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
#[UniqueEntity(fields: ['username'], message: 'There is already an account with this username')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank(message: 'Please eneter your email')]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 15)]
    #[Assert\NotBlank(message: 'Please eneter your username')]
    private ?string $username = null;

    #[ORM\OneToMany(targetEntity: CommentVote::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $commentVotes;

    #[ORM\OneToMany(targetEntity: ReviewLike::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $reviewLikes;

    public function __construct()
    {
        $this->commentVotes = new ArrayCollection();
        $this->reviewLikes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return Collection<int, CommentVote>
     */
    public function getCommentVotes(): Collection
    {
        return $this->commentVotes;
    }

    public function addCommentVote(CommentVote $commentVote): static
    {
        if (!$this->commentVotes->contains($commentVote)) {
            $this->commentVotes->add($commentVote);
            $commentVote->setUser($this);
        }

        return $this;
    }

    public function removeCommentVote(CommentVote $commentVote): static
    {
        if ($this->commentVotes->removeElement($commentVote)) {
            // set the owning side to null (unless already changed)
            if ($commentVote->getUser() === $this) {
                $commentVote->setUser(null);
            }
        }

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
            $reviewLike->setUser($this);
        }

        return $this;
    }

    public function removeReviewLike(ReviewLike $reviewLike): static
    {
        if ($this->reviewLikes->removeElement($reviewLike)) {
            // set the owning side to null (unless already changed)
            if ($reviewLike->getUser() === $this) {
                $reviewLike->setUser(null);
            }
        }

        return $this;
    }
}
