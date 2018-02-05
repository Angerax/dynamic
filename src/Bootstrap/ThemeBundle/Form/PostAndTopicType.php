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

class PostAndTopicType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('topic', \Admin\AdminBundle\Form\TopicType::class)
                ->add('post', PostType::class)
                ->add('Enregistrer',SubmitType::class);
        
        $builder->get('topic')->remove('Enregistrer');
        $builder->get('post')->remove('Enregistrer');
        
    }
    
    
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Bootstrap\ThemeBundle\Entity\PostAndTopic'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Bootstrap_themebundle_postandtopic';
    }


}