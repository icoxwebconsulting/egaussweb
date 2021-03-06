<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class MisionVisionEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('urlvideo',null, array("label"=> 'URL Video'))
            ->add('presentacion',FileType::class, array('label' => 'Archivo de Presentación','required'=>false))
            //->add('texto', CKEditorType::class, array('input_sync' => true))
            ->add('texto', CKEditorType::class
               /* , array(
                'config_name' => 'my_config_1',
            )*/
            )

            /*->add('texto',TextareaType::class,array(
                'label' => 'Texto',
                'attr'  => array('class' => 'materialize-textarea')
            ))*/
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\MisionVision'
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\MisionVision'
        ));
    }

    public function getName() {
        return 'backendbundle_misionvisionedit';
    }
}
