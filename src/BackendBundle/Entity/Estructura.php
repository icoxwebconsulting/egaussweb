<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Estructura
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="estructura")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\EstructuraRepository")
 */
class Estructura
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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $texto;


    /**
     * @ORM\Column(type="text")
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    protected $urlvideo;



    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $titular;




    /**
     * @var string $path
     * @ORM\Column(name="path", type="string", nullable=true)
     */
    protected $path;
    protected $temp;


    /**
     * @var string $path
     * @ORM\Column(name="pathpresentacion", type="string", nullable=true)
     */
    protected $pathpresentacion;
    protected $temppresentacion;

    /**
     * @Assert\Image(
     *         minWidth = 1200,
     *         minHeight = 800,
     *         maxSize ="4M",
     *         mimeTypes = {"image/jpg","image/png","image/gif","image/jpeg"},
     *         minWidthMessage = "El ancho ({{ width }}px) de la imagen es muy pequeño. El Minimo ancho esperado es {{ min_width }}px.",
     *         minHeightMessage = "El alto ({{ height }}px) de la imagen es muy pequeño. El Minimo alto esperado es {{ min_height }}px.",
     *         mimeTypesMessage = "Seleccione un archivo tipo jpg, png, gif o jpeg.",
     *         maxSizeMessage = "El tamaño de la imagen no debe pasar los 4Mb."
     * )
     *
     */
    protected $foto;


    /**
     * @Assert\File(maxSize ="4M")
     * 
     */
    protected $presentacion;


    public function __construct() {
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

    /**
     * Sets foto.
     *
     * @param UploadedFile $foto
     */
    public function setPresentacion(UploadedFile $presentacion = null) {
        $this->presentacion = $presentacion;
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
        return 'uploads/estructura/' . $this->id;
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

    public function getAbsolutePathPresentacion() {
        return null === $this->pathpresentacion ? null : $this->getUploadRootDir() . '/' . $this->pathpresentacion;
    }

    public function getWebPathPresentacion() {
        return null === $this->pathpresentacion ? null : $this->getUploadDir() . '/' . $this->pathpresentacion;
    }

    public function getAbsoluteCropPathPresentacion() {
        return null === $this->pathpresentacion ? null : $this->getUploadRootDir() . '/crop_' . $this->pathpresentacion;
    }

    public function getThumbnailPresentacion() {
        //return null === $this->pathpresentacion ? null : $this->getUploadDir() . '/min_' . $this->path;
        if (file_exists($this->getUploadDir() . '/min_' . $this->pathpresentacion)){
            return $this->getUploadDir() . '/min_' . $this->pathpresentacion;
        }else{
            return $this->getWebPath();
        }
    }

    public function getThumbnailPresentacionMedium() {
        //return null === $this->pathpresentacion ? null : $this->getUploadDir() . '/medium_' . $this->path;
        if (file_exists($this->getUploadDir() . '/medium_' . $this->pathpresentacion)){
            return $this->getUploadDir() . '/medium_' . $this->pathpresentacion;
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
        if (NULL !== $this->presentacion) {
            $fotoname = sha1(uniqid(mt_rand(), true));
            $this->pathpresentacion = $fotoname . '.' . $this->getPresentacion()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload() {
        if (null === $this->getFoto() && null === $this->getPresentacion() ) {
            return;
        }

        if($this->getFoto() != null) {
            $mimeTypeF = $this->getFoto()->getMimeType();
        }

        /*if($this->getPresentacion() != null){
            $mimeTypeP = $this->getPresentacion()->getMimeType();
        }*/

        if (isset($this->temp)) {
            try {
                unlink($this->getUploadRootDir() . '/' . $this->temp);
            } catch (\Exception $e) {
                //nada
            }
            $this->temp = null;
        }
        if($this->getFoto() != null) {
            $this->getFoto()->move($this->getUploadRootDir(), $this->path);

            $porcentajes = array(0.5, 0.7);

            foreach ($porcentajes as $porcentaje) {
                $this->resize($porcentaje, $mimeTypeF, $this->getWebPath(), $this->path);
            }
            $this->foto = null;
        }

        if (isset($this->temppresentacion)) {
            try {
                unlink($this->getUploadRootDir() . '/' . $this->temppresentacion);
            } catch (\Exception $e) {
                //nada
            }
            $this->temppresentacion = null;
        }
        if($this->getPresentacion() != null) {
            $this->getPresentacion()->move($this->getUploadRootDir(), $this->pathpresentacion);

            $this->presentacion = null;
        }
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

        if ($foto = $this->getAbsolutePathPresentacion()) {
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

    public function resize($porcentaje, $mimeType, $capture, $valor){
        // Nuevo tamaño
        if($porcentaje == 0.5){
            $per = '/min_';
        }elseif($porcentaje == 0.7){
            $per = '/medium_';
        }

        // Obtener los nuevos tamaños
        list($ancho, $alto) = getimagesize($capture);
        $nuevo_ancho = $ancho * $porcentaje;
        $nuevo_alto = $alto * $porcentaje;

        // Cargar
        $thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
        $imgString = file_get_contents($capture);
        $origen = imagecreatefromstring($imgString);

        // Cambiar el tamaño
        imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

        // Imprimir
        switch ($mimeType) {
            case 'image/jpeg':
                imagejpeg($thumb, $this->getUploadRootDir(). $per . $valor);
                break;
            case 'image/png':
                imagepng($thumb, $this->getUploadRootDir(). $per . $valor);
                break;
            case 'image/gif':
                imagegif($thumb, $this->getUploadRootDir(). $per . $valor);
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
     * Set path
     *
     * @param string $path
     * @return Document
     */
    public function setPathPresentacion($path) {
        $this->pathpresentacion = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPathPresentacion() {
        return $this->pathpresentacion;
    }

    /**
     * Get foto
     *
     * @return UploadedFile
     */
    public function getFoto() {
        return $this->foto;
    }

    public function getPresentacion() {
        return $this->presentacion;
    }

    /**
     * Set texto
     *
     * @param string $texto
     *
     * @return Servicio
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Servicio
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
     * Set link
     *
     * @param string $link
     *
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * Set urlvideo
     *
     * @param string $urlvideo
     *
     * @return Estructura
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
