<?php

namespace App\Form;

use App\Entity\Message;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Message::class,
            'validation_groups' => ['create'],
            'role' => ['ROLE_USER'],
            'isClosed' => false
        ));
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if (in_array('ROLE_ADMIN', $options['role'])){
        $builder
            ->add('creator_email')
            ->add('reply_to_id')
            ->add('isClosed')
            ->add('text')

        ;
    }
        else{
        $builder
            ->add('creator_email')
            ->add('reply_to_id')
            // ->add('isClosed', array('disabled' => true, 'data' => false))
            ->add('text')
        ;
        }}

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         'data_class' => Message::class,
    //     ]);
    // }

}


