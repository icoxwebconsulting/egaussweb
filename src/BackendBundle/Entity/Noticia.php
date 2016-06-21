<?php

namespace BackendBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Mapping\ClassMetadata;
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
     * @ORM\Column(type="text", nullable=true)
     */
    protected $texto;


    /**
     * @ORM\Column(type="text")
     */
    protected $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $fecha;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $empresa;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $tecnologia;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $ciudad;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $cientifico;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $universidad;


    /**
     * @var string $path
     * @ORM\Column(name="path", type="string", nullable=true)
     */
    protected $path;
    protected $temp;

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


    public function __construct() {
        $this->created_at = new \DateTime("now");
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

    public function resize($porcentaje, $mimeType){
        // Fichero y nuevo tamaño
        //$nombre_fichero = 'prueba.jpg';
        //$porcentaje = 0.2;

        // Tipo de contenido
        //        header('Content-Type: image/jpeg');

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
        //$origen = imagecreatefromjpeg($this->getWebPath());

        // Cambiar el tamaño
        imagecopyresized($thumb, $origen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

        // Imprimir
        //imagejpeg($thumb, $this->getUploadRootDir(). '/crop_' . $this->path);
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

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Noticia
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     *
     * @return Noticia
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return string
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set tecnologia
     *
     * @param string $tecnologia
     *
     * @return Noticia
     */
    public function setTecnologia($tecnologia)
    {
        $this->tecnologia = $tecnologia;

        return $this;
    }

    /**
     * Get tecnologia
     *
     * @return string
     */
    public function getTecnologia()
    {
        return $this->tecnologia;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return Noticia
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set cientifico
     *
     * @param string $cientifico
     *
     * @return Noticia
     */
    public function setCientifico($cientifico)
    {
        $this->cientifico = $cientifico;

        return $this;
    }

    /**
     * Get cientifico
     *
     * @return string
     */
    public function getCientifico()
    {
        return $this->cientifico;
    }

    /**
     * Set universidad
     *
     * @param string $universidad
     *
     * @return Noticia
     */
    public function setUniversidad($universidad)
    {
        $this->universidad = $universidad;

        return $this;
    }

    /**
     * Get universidad
     *
     * @return string
     */
    public function getUniversidad()
    {
        return $this->universidad;
    }
}
