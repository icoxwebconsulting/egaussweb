<?php

namespace BackendBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Noticia
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="noticia")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\NoticiaRepository")
 */
class Noticia
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
     * @ORM\Column(type="text")
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $link;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $titular;

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
        $this->slug = $this->slugify($this->titular);
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
        return 'uploads/noticias/' . $this->id;
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
     * @return Noticia
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
     * @return Noticia
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
     * Set owner
     *
     * @param string $owner
     *
     * @return Noticia
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
     * Set titular
     *
     * @param string $titular
     *
     * @return Noticia
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
     * @return Noticia
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

    public function slugify ($text) {
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        return strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $text));
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Noticia
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
}
