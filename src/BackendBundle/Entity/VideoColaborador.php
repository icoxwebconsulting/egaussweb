<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VideoColaborador
 *
 * @ORM\Table(name="video_colaborador")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\VideoColaboradorRepository")
 */
class VideoColaborador
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

