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
     * @ORM\Column(type="string", length=512, nullable=false)
     */
    protected $titulo;


    /**
     * @ORM\Column(type="string", length=512, nullable=false)
     */
    protected $url;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $descripcion;


    /**
     * @ORM\Column(type="string", length=512, nullable=false)
     */
    protected $owner;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return VideoColaborador
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return VideoColaborador
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set owner
     *
     * @param string $owner
     *
     * @return VideoColaborador
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get owner
     *
     * @return string
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return VideoColaborador
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }
}
