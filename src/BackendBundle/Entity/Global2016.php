<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Global2016
 *
 * @ORM\Table(name="global2016")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\Global2016Repository")
 */
class Global2016
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
     * @ORM\Column(type="text")
     */
    protected $texto;



    public function __construct()
    {
        $this->files = array();
        $this->documents = array();
    }


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
     * @return Global2016
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
     * Set texto
     *
     * @param string $texto
     *
     * @return Global2016
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

    /**
     * Add document
     *
     * @param \BackendBundle\Entity\File $document
     *
     * @return Global2016
     */
    public function addDocument(\BackendBundle\Entity\File $document)
    {
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \BackendBundle\Entity\File $document
     */
    public function removeDocument(\BackendBundle\Entity\File $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }



/**
 * @ORM\PostPersist()
 * @ORM\PostUpdate()
 */
public function upload()
{
    foreach ($this->documents as $image){
        $image->upload();
    }
}

/**
 * @ORM\PreRemove()
 */
public function preRemoveUpload()
{
    foreach ($this->documents as $image){
        $image->preRemoveUpload();
    }
}

/**
 * @ORM\PostRemove()
 */
public function removeUpload()
{
    foreach ($this->documents as $image){
        $image->removeUpload();
    }
}
}
