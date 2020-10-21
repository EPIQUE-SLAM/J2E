<?php
/**
 * Created by PhpStorm.
 * User: COLARD Fanny, DANEL Maxime
 * Date: 04/10/2020
 * Time: 14:41
 */

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Passager
 * @package App\Entity
 * @ORM\Table(name="Passager")
 * @ApiResource()
 * @ORM\Entity()
 */
class Passager
{
    /**
     ** @ORM\Id
     * @ORM\Column(name="Id_passager", type="integer")
     * @Assert\NotNull()
     */
    private $id;
    /**
     * @ORM\Column(name="nom",type="text")
     *
     */
    private $nom;

    /**
     * @ORM\Column(name="prenom",type="text")
     *
     */
    private $prenom;


    /**
     * @ORM\Column(name="email", type="text")
     *
     */
    public $email;


    /**
     * @ORM\Column(name="telephone", type="text")
     *
     */
    public $telephone;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getTelephone(): int
    {
        return $this->telephone;
    }

    /**
     * @param string $telephone
     */
    public function setTelephone(int $telephone): void
    {
        $this->telephone = $telephone;
    }


}