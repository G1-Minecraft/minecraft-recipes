<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Regex;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',  EmailType::class, [
                'required' => false
                ])
            ->add('newPlainPassword', PasswordType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Regex(
                        pattern: '#^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,30}$#',
                        message: 'Incorrect password (must contain atleast a digit, a lowercase and an uppercase and be between 8 and 30 characters)'
                    )
                ]
            ])
            ->add('profilePictureFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'accept' => 'image/png, image/jpeg'
                ],
                'constraints' => [
                    new File(
                        maxSize: '10M',
                        mimeTypes: ['image/jpeg', 'image/png'],
                        maxSizeMessage: 'The file is above the maximum tolerated size (10 Mo)',
                        mimeTypesMessage: 'The file must have a valid extension (jpg or png)',

                    )
                ]
            ])
            ->add('edit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
