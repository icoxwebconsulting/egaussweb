<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class NoticiaEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titular')
            ->add('fecha', DateType::class ,array(
                'label' => 'Fecha',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr'  => array('class' => 'datepicker')
            ))
            ->add('texto',TextareaType::class,array(
                'label' => 'Texto',
                'attr'  => array('class' => 'materialize-textarea')
            ))
            ->add('foto',FileType::class, array('label' => 'Foto','required'=>false))
            ->add('link')
            ->add('universidad')
            ->add('empresa')
            ->add('ciudad')
            ->add('tecnologia')
            ->add('cientifico')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Noticia'
        ));
    }
}
