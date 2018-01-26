<?php

namespace Bootstrap\ThemeBundle\Form;

use Doctrine\ORM\EntityRepository;
use Bootstrap\ThemeBundle\Entity\Post;
use Bootstrap\ThemeBundle\Repository\PostRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Message', null, array('property_path' => 'message'))
                ->add('lien', null, array('property_path' => 'url'))
                ->add('embed', null, array('property_path' => 'embed'))
                ->add('topics', EntityType::class,
                        array(
                            'class'=> 'Bootstrap\ThemeBundle\Entity\Topic',
                            'choice_label'=>'name',
                            'expanded'=> false,
                            'multiple'=> false,
                        )
                        )
                ->add('Enregistrer',SubmitType::class);
    }
    
    
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bootstrap\ThemeBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Bootstrap_themebundle_post';
    }


}