<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * QuienesSomos
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="quienes_somos")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\QuienesSomosRepository")
 */
class QuienesSomos
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
     * @var string $path
     * @ORM\Column(name="path", type="string", nullable=true)
     */
    protected $path;
    protected $temp;

    /**
     *  @Assert\Image(
     *         minWidth = 1200,
     *         minHeight = 800,
     *         maxSize ="4M",
     *         mimeTypes = {"image/jpg","image/png","image/gif","image/jpeg"},
     *         minWidthMessage = "El ancho ({{ width }}px) de la imagen es muy pequeño. El Minimo ancho esperado es {{ min_width }}px.",
     *         minHeightMessage = "El alto ({{ height }}px) de la imagen es muy pequeño. El Minimo alto esperado es {{ min_height }}px.",
     *         mimeTypesMessage = "Seleccione un archivo tipo jpg, png, gif o jpeg.",
     *         maxSizeMessage = "El tamaño de la imagen no debe pasar los 4Mb."
     * )
     * @Assert\NotBlank
     */
    protected $foto;


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
        return 'uploads/quienessomos/' . $this->id;
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
        //return null === $this->path ? null : $this->getUploadDir() . '/min_' . $this->path;
        if (file_exists($this->getUploadDir() . '/min_' . $this->path)){
            return $this->getUploadDir() . '/min_' . $this->path;
        }else{
            return $this->getWebPath();
        }
    }

    public function getThumbnailMedium() {
        //return null === $this->path ? null : $this->getUploadDir() . '/medium_' . $this->path;
        if (file_exists($this->getUploadDir() . '/medium_' . $this->path)){
            return $this->getUploadDir() . '/medium_' . $this->path;
        }else{
            return $this->getWebPath();
        }
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

        $mimeType = $this->getFoto()->getMimeType();

        if (isset($this->temp)) {
            try {
                unlink($this->getUploadRootDir() . '/' . $this->temp);
            } catch (\Exception $e) {
                //nada
            }
            $this->temp = null;
        }
        $this->getFoto()->move($this->getUploadRootDir(), $this->path);

        $porcentajes = array(0.5, 0.7);

        foreach($porcentajes as $porcentaje){
            $this->resize($porcentaje, $mimeType);
        }

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
     * @param $porcentaje
     * @param $mimeType
     */

    public function resize($porcentaje, $mimeType){
        // Nuevo tamaño
        if($porcentaje == 0.5){
            $per = '/min_';
        }elseif($porcentaje == 0.7){
            $per = '/medium_';
        }

        // Obtener los nuevos tamaños
        list($ancho, $alto) = getimagesize($this->getWebPath());
        $nuevo_ancho = $ancho * $porcentaje;
        $nuevo_alto = $alto * $porcentaje;

        // Cargar
        $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
        $imgString = file_get_contents($this->getWebPath());
        $origen = imagecreatefromstring($imgString);

        // Cambiar el tamaño
        imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

        // Imprimir
        switch ($mimeType) {
            case 'image/jpeg':
                imagejpeg($thumb, $this->getUploadRootDir(). $per . $this->path);
                break;
            case 'image/png':
                imagepng($thumb, $this->getUploadRootDir(). $per . $this->path);
                break;
            case 'image/gif':
                imagegif($thumb, $this->getUploadRootDir(). $per . $this->path);
                break;
            default:
                exit;
                break;
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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return QuienesSomos
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
}
