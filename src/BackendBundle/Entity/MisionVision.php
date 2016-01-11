<?php
/**
 * Created by IntelliJ IDEA.
 * User: diole
 * Date: 09/01/16
 * Time: 01:54 PM
 */

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * MisionVision
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="mision_vision")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\MisionVisionRepository")
 */
class MisionVision
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $titulo;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $urlvideo;

    /**
     * @var string $path
     * @ORM\Column(name="path", type="string", nullable=true)
     */
    protected $path;
    protected $temp;

    /**
     * @Assert\File(maxSize ="4M")
     * @Assert\NotBlank
     */
    protected $presentacion;




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
     * Sets presentacion.
     *
     * @param UploadedFile $presentacion
     */
    public function setPresentacion(UploadedFile $presentacion = null) {
        $this->presentacion = $presentacion;
        // check if we have an old presentacion path
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
        return 'uploads/misionvision/' . $this->id;
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
        if (NULL !== $this->presentacion) {
            $presentacionname = sha1(uniqid(mt_rand(), true));
            $this->path = $presentacionname . '.' . $this->getPresentacion()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getPresentacion()) {
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
        $this->getPresentacion()->move($this->getUploadRootDir(), $this->path);
        $this->presentacion = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload() {
        if ($presentacion = $this->getAbsolutePath()) {
            try {
                unlink($presentacion);
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
     * Get presentacion
     *
     * @return UploadedFile
     */
    public function getPresentacion() {
        return $this->presentacion;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Pagina
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
     * @return Pagina
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
     * Set urlvideo
     *
     * @param string $urlvideo
     *
     * @return MisionVision
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
}
