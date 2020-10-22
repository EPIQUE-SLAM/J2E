<?php
/**
 * Created by PhpStorm.
 * User: COLARD Fanny, DANEL Maxime
 * Date: 04/10/2020
 * Time: 14:57
 */

namespace App\Entity;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Voyage
 * @package App\Entity
 * @ORM\Table(name="Voyage")
 * @ApiResource()
 * @ORM\Entity()
 */
class Voyage
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id_voyage", type="integer")
     * @Assert\NotNull()
     */
    public $idVoyage;

    /**
     * @ORM\Column(name="date", type="text")
     */
   public $date;

    /**
     * @ORM\Column(name="type", type="text")
     */
    public $type;

    /**
     * @ORM\Column(name="num_transport")
     */
    public $num_transport;

    /**
     * @ORM\Column(name="lieu_depart", type="text")
     */
    public $lieu_depart;

    /**
     * @ORM\Column(name="lieu_arrivee", type="text")
     */
    public $lieu_arrivee;

    /**
     * @return int
     */
    public function getIdVoyage(): int
    {
        return $this->idVoyage;
    }

    /**
     * @param int $id_voyage
     */
    public function setIdVoyage(int $id_voyage): void
    {
        $this->idVoyage = $id_voyage;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getNumTransport(): string
    {
        return $this->num_transport;
    }

    /**
     * @param string $num_transport
     */
    public function setNumTransport(string $num_transport): void
    {
        $this->num_transport = $num_transport;
    }

    /**
     * @return string
     */
    public function getLieuDepart(): string
    {
        return $this->lieu_depart;
    }

    /**
     * @param string $lieu_depart
     */
    public function setLieuDepart(string $lieu_depart): void
    {
        $this->lieu_depart = $lieu_depart;
    }

    /**
     * @return string
     */
    public function getLieuArrivee(): string
    {
        return $this->lieu_arrivee;
    }

    /**
     * @param string $lieu_arrivee
     */
    public function setLieuArrivee(string $lieu_arrivee): void
    {
        $this->lieu_arrivee = $lieu_arrivee;
    }




}