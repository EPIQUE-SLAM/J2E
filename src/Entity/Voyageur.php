<?php


namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Voyageur
 * @package App\Entity
 * @ORM\Table(name="Voyageur")
 * @ApiResource()
 * @ORM\Entity()
 */

class Voyageur
{
    /**
     ** @ORM\Id
     * @ORM\Column(name="id_voyageur", type="integer")
     * @Assert\NotNull()
     * @ORM\GeneratedValue()
     */
    private $id_voyageur;
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
     * @return mixed
     */
    public function getIdVoyageur()
    {
        return $this->id_voyageur;
    }

    /**
     * @param mixed $id_voyageur
     */
    public function setIdVoyageur($id_voyageur): void
    {
        $this->id_voyageur = $id_voyageur;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }


}