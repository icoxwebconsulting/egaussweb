<?php

namespace BackendBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Banner
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="banner")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\BannerRepository")
 */
class Banner
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
     * @ORM\Column(type="text")
     */
    protected $texto;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $titular;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $sitio_web;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha;


    /**
     * @var string $path
     * @ORM\Column(name="path", type="string", nullable=true)
     */
    protected $path;
    protected $temp;

    /**
     * @Assert\File(maxSize ="4M",mimeTypes = {"image/jpg","image/png","image/gif","image/jpeg"})
     * @Assert\NotBlank
     */
    protected $foto;


    public function __construct() {
        $this->fecha = new \DateTime("now");
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
     * Sets foto.
     *
     * @param UploadedFile $foto
     */
    public function setFoto(UploadedFile $foto = null) {
        $this->foto = $foto;
        // check if we have an old foto path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    protected function getUploadRootDir() {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir() {
        return 'uploads/banners/' . $this->id;
    }

    public function getAbsolutePath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath() {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    public function getAbsoluteCropPath() {
        return null === $this->path ? null : $this->getUploadRootDir() . '/crop_' . $this->path;
    }

    public function getThumbnail() {
        return null === $this->path ? null : $this->getUploadDir() . '/crop_' . $this->path;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload() {
        if (NULL !== $this->foto) {
            $fotoname = sha1(uniqid(mt_rand(), true));
            $this->path = $fotoname . '.' . $this->getFoto()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getFoto()) {
            return;
        }
        if (isset($this->temp)) {
            try {
                unlink($this->getUploadRootDir() . '/' . $this->temp);
            } catch (\Exception $e) {
                //nada
            }
            $this->temp = null;
        }
        $this->getFoto()->move($this->getUploadRootDir(), $this->path);
        $this->foto = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($foto = $this->getAbsolutePath()) {
            try {
                unlink($foto);
            } catch (\Exception $e) {
                //ignore
            }
        }
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Document
     */
    public function setPath($path) {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Get foto
     *
     * @return UploadedFile
     */
    public function getFoto() {
        return $this->foto;
    }

    /**
     * Set texto
     *
     * @param string $texto
     *
     * @return Banner
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
     * Set link
     *
     * @param string $link
     *
     * @return Banner
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }



    /**
     * Set titular
     *
     * @param string $titular
     *
     * @return Banner
     */
    public function setTitular($titular)
    {
        $this->titular = $titular;

        return $this;
    }

    /**
     * Get titular
     *
     * @return string
     */
    public function getTitular()
    {
        return $this->titular;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Banner
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set sitioWeb
     *
     * @param string $sitioWeb
     *
     * @return Banner
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
