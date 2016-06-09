<?php

namespace BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

class BannerEditType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titular')
            ->add('sitio_web', ChoiceType::class, array(
                'choices'  => array(
                    'Egauss Holding' => "Egauss Holding",
                    'Global ImasT' => "Global ImasT",
                )))
            ->add('link')
            ->add('texto', CKEditorType::class)
            /*->add('texto',TextareaType::class,array(
                'label' => 'Texto',
                'attr'  => array('class' => 'materialize-textarea')
            ))*/
            ->add('foto',FileType::class, array('label' => 'Foto','required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Banner'
        ));
    }
}
