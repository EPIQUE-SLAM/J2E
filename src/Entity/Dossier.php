<?php
/**
 * Created by PhpStorm.
 * User: EPIQUE-SLAM
 * Date: 04/10/2020
 * Time: 14:57
 */

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Dossier
 * @package App\Entity
 * @ORM\Table(name="Dossier_V")
 * @ApiResource()
 * @ORM\Entity()
 */
class Dossier
{
    /**
     * @ORM\Id
     * @ORM\Column(name="reference_dossier", type="integer")
     * @Assert\NotNull()
     */
    public $reference_dossier;

    /**
     * @var integer
     * @ORM\Column(name="voyage", type="integer")
     *
     */
    public $voyage;

    /**
     * @var boolean
     */
    public $trajetEffectue;

    /**
     *
     * @ORM\Column(name="idPassager", type="integer")
     */
    public $idPassager;


    /**
     *
     * @ORM\Column(name="date", type="text")
     */
    public $date;




    /**
     * @return bool
     */
    public function isTrajetEffectue(): bool
    {
        return $this->trajetEffectue;
    }

    /**
     * @param bool $trajetEffectue
     */
    public function setTrajetEffectue(bool $trajetEffectue): void
    {
        $this->trajetEffectue = $trajetEffectue;
    }

    /**
     * @return int
     */
    public function getIdPassager(): int
    {
        return $this->idPassager;
    }

    /**
     * @param int $idPassager
     */
    public function setIdPassager(int $idPassager): void
    {
        $this->idPassager = $idPassager;
    }

    /**
     * @return int
     */
    public function getReferenceDossier(): int
    {
        return $this->reference_dossier;
    }

    /**
     * @param int $reference_dossier
     */
    public function setReferenceDossier(int $reference_dossier): void
    {
        $this->reference_dossier = $reference_dossier;
    }

    /**
     * @return int
     */
    public function getVoyage(): int
    {
        return $this->voyage;
    }

    /**
     * @param int $voyage
     */
    public function setVoyage(int $voyage): void
    {
        $this->voyage = $voyage;
    }




}