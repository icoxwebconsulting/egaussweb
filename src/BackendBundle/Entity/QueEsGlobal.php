<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * QueEsGlobal
 *
 * @ORM\Table(name="que_es_global")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\QueEsGlobalRepository")
 */
class QueEsGlobal
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
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $titulo;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $urlvideo;

    /**
     * @ORM\Column(type="text")
     */
    protected $texto;


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
     * @return QueEsGlobal
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
     * Set urlvideo
     *
     * @param string $urlvideo
     *
     * @return QueEsGlobal
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
     * Set texto
     *
     * @param string $texto
     *
     * @return QueEsGlobal
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }
}
