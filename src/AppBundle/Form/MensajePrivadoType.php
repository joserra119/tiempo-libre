<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class MensajePrivadoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$user=$options['empty_data'];
        $builder
					
//				->add('receptor', EntityType::class,array(
//					'class'=>'BackendBundle:Usuario',
//					'query_builder' =>function($er) use($user) {
//					return $er->createQueryBuilder('u');
//					},
//					'label' =>' Para: ',
//					'attr' =>array('class'=> 'form-control'),
//					'choice_label'=>function($user){
//						return $user->getNombre()." ". $user->getApellidos()." ". $user->getNick();
//					}					
//				))
				
//				->add('usuario', TextareaType::class, array(
//					'label' => 'Usuario',
//					'required' => 'required',
//					'attr' => array(
//						'class'=> 'form-bio form-control'
//					)
//					
//				)
//				)
				
				->add('mensaje', TextareaType::class, array(
					'label' => 'Mensaje',
					'required' => 'required',
					'attr' => array(
						'class'=> 'form-bio form-control'
					)
					
				)
				)
				
				
				
				->add('imagen', FileType::class, array(
					'label' => 'Foto ( .jpg, .jpeg, .png, .bmp)',
					'required' => false,
					'data_class' => null,
					'attr' => array(
						'class'=> 'form-image form-control'
					)
					
				)
				)
				
				->add('archivo', FileType::class, array(
					'label' => 'Documento ( .pdf)',
					'required' => false,
					'data_class' => null,
					'attr' => array(
						'class'=> 'form-control'
					)
					
				)
				)
			
				->add('Enviar', SubmitType::class, array(
					"attr" => array(
						"class" => " btn btn-success"
					)
				));
				
				
				
				
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\MensajePrivado'
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
