<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\VideoRepository")
 */
class Video
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
     * @ORM\Column(type="string", length=255)
     */
    protected $sitio_web;


    /**
     * @ORM\Column(type="string", length=512, nullable=false)
     */
    protected $url;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $inhomepage;


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
     * Set url
     *
     * @param string $url
     *
     * @return Video
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
     * Set inhomepage
     *
     * @param boolean $inhomepage
     *
     * @return Video
     */
    public function setInhomepage($inhomepage)
    {
        $this->inhomepage = $inhomepage;

        return $this;
    }

    /**
     * Get inhomepage
     *
     * @return boolean
     */
    public function getInhomepage()
    {
        return $this->inhomepage;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Video
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
     * Set sitioWeb
     *
     * @param string $sitioWeb
     *
     * @return Video
     */
    public function setSitioWeb($sitioWeb)
    {
        $this->sitio_web = $sitioWeb;

        return $this;
    }

    /**
     * Get sitioWeb
     *
     * @return string
     */
    public function getSitioWeb()
    {
        return $this->sitio_web;
    }
}
