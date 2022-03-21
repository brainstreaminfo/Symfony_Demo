<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class User
 * @package App\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer", name="id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, name="first_name", nullable=false)
     * @Assert\NotBlank(message="First name can not be blank")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "First name must be at least {{ limit }} characters long",
     *      maxMessage = "First name cannot be longer than {{ limit }} characters"
     * )
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, name="last_name", nullable=false)
     * @Assert\NotBlank(message="Last name can not be blank")
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Last name must be at least {{ limit }} characters long",
     *      maxMessage = "Last name cannot be longer than {{ limit }} characters"
     * )
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, name="email", nullable=false)
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", name="password", nullable=false)
     * @Assert\NotBlank(message="Password can not be blank")
     * @Assert\Length(
     *      min = 4,
     *      max = 50,
     *      minMessage = "Password must be at least {{ limit }} characters long",
     *      maxMessage = "Password cannot be longer than {{ limit }} characters"
     * )
     */
    private $password;

    /**
     * @var DateTime|null
     * @ORM\Column(type="datetime", nullable=true, name="date_created")
     */
    private $dateCreated;

    /**
     * @var DateTime|null
     * @ORM\Column(type="datetime", nullable=true, name="date_updated")
     */
    private $dateUpdated;

    /**
     * @ORM\Column(type="string", length=255, name="avatar", nullable=true)
     */
    private $avatar;

    /**
     * User constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->dateCreated = new \DateTime();
        $this->dateUpdated = new \DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return (string)$this->password;
    }

    /**
     * @param string $password
     *
     * @return User
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTimeInterface|null $dateCreated
     *
     * @return User
     */
    public function setDateCreated(?\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->dateUpdated;
    }

    /**
     * @param \DateTimeInterface|null $dateUpdated
     *
     * @return User
     */
    public function setDateUpdated(?\DateTimeInterface $dateUpdated): self
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    /**
     * @return array|string[]
     */
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    /**
     *
     */
    public function eraseCredentials()
    {
    }

    /**
     * @return string|void
     */
    public function getUsername()
    {
    }

    /**
     * @return string|void
     */
    public function getUserIdentifier()
    {
    }

    /**
     * @return string|null
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    /**
     * @param string|null $avatar
     *
     * @return User
     */
    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }
}
