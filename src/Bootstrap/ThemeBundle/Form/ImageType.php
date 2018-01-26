<?php

namespace Bootstrap\ThemeBundle\Form;

use Doctrine\ORM\EntityRepository;
use Bootstrap\ThemeBundle\Entity\Users;
use Bootstrap\ThemeBundle\PostRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('imagesFile', FileType::class, 
                    array(
                        'data_class' => null
                    ))
                ->add('Enregistrer',SubmitType::class);
    }
    
    
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bootstrap\ThemeBundle\Entity\Users'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Bootstrap_themebundle_users';
    }


}