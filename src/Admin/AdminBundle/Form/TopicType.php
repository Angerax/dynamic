<?php

namespace Admin\AdminBundle\Form;

use Doctrine\ORM\EntityRepository;
use OC\PlatformBundle\Entity\Topic;
use OC\PlatformBundle\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TopicType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Tags', null, array('property_path' => 'tag'))
                ->add('Titre', null, array('property_path' => 'name'))
                ->add('Categories', EntityType::class,
                        array(
                            'class'=> 'Bootstrap\ThemeBundle\Entity\Category',
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
            'data_class' => 'Bootstrap\ThemeBundle\Entity\Topic'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Bootstrap_themebundle_topic';
    }


}