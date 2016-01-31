<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * EdicionAnterior
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="edicion_anterior")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\EdicionAnteriorRepository")
 */
class EdicionAnterior
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
     * @ORM\Column(type="string", length=100)
     */
    protected $titulo;

    /**
     * @ORM\Column(type="text")
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $urlvideo;


    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $anio;


    /**
     * @ORM\Column(type="text")
     */
    protected $descripcion;



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
     * @return EdicionAnterior
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
     * Set slug
     *
     * @param string $slug
     *
     * @return EdicionAnterior
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set urlvideo
     *
     * @param string $urlvideo
     *
     * @return EdicionAnterior
     */
    public function setUrlvideo($urlvideo)
    {
        $this->urlvideo = $urlvideo;

        return $this;
    }

    /**
     * Get urlvideo
     *
     * @return string
     */
    public function getUrlvideo()
    {
        return $this->urlvideo;
    }

    /**
     * Set anio
     *
     * @param string $anio
     *
     * @return EdicionAnterior
     */
    public function setAnio($anio)
    {
        $this->anio = $anio;

        return $this;
    }

    /**
     * Get anio
     *
     * @return string
     */
    public function getAnio()
    {
        return $this->anio;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return EdicionAnterior
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

    /**
     * Set paths
     *
     * @param string $paths
     *
     * @return EdicionAnterior
     */
    public function setPaths($paths)
    {
        $this->paths = $paths;

        return $this;
    }

    /**
     * Get paths
     *
     * @return string
     */
    public function getPaths()
    {
        return $this->paths;
    }

    public function slugify ($text) {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
    }

    public function generaOwner(){
        return $this->slugify($this->titulo).$this->id;
    }
}
