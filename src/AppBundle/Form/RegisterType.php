<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class RegisterType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
				
				
				->add('nombre', TextType::class, array(
					'label' => 'Nombre',
					'required' => false,
					'attr' => array (
						'class' => 'form-name, form-control'
					)
					
					
				))
				->add('apellidos',TextType::class, array(
					'label' => 'Apellidos',
					'required' => false,
					'attr' => array (
						'class' => 'form-surname, form-control'
					)
					
					
				))
				
				->add('nick', TextType::class, array(
					'label' => 'Usuario',
					'required' => false,
					'attr' => array (
						'class' => 'form-surname, form-control'
					))
				)
				
				->add('email', EmailType::class, array(
					'label' => 'Correo electrónico',
					'required' => false,
					'attr' => array(
						'class'=> 'form-email form-control'
					)
					
				)
				)

               ->add('password', PasswordType::class, array(
                    'label' => 'Password',
                    'required' => 'required',
                    'attr' => array(
                        'class'=> 'form-password form-control'
                    )

                 )
              )

				->add('biografia', TextareaType::class, array(
					'label' => 'Biografía',
					'required' => false,
					'attr' => array(
						'class'=> 'form-bio form-control'
					)
					
				)
				)
				
				->add('imagen', FileType::class, array(
					'label' => 'Foto',
					'required' => false,
					'data_class' => null,
					'attr' => array(
						'class'=> 'form-image form-control'
					)
					
				)
				)
				
				->add('Guardar', SubmitType::class, array(
					"attr" => array(
						"class" => "form-submit btn btn-success"
					)
				));
				
				
				
				
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Usuario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'backendbundle_usuario';
    }


}
