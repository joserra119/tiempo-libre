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
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class ComentariosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$publication=$options['empty_data'];
		$user=$options['allow_extra_fields'];
        $builder
					
				->add('receptor', EntityType::class,array(
					'class'=>'BackendBundle:Usuario',
					'query_builder' =>function($er) use($publication,$user) {
					return $er->getUsuariosPublicacion($publication,$user)
							
							;
					},
					'label' =>' Para: ',
							'required'=>'required',
					'attr' =>array('class'=> 'form-control'),
					'choice_label'=>function($user){
						return $user->getNombre()." ". $user->getApellidos()." ". $user->getNick();
					}					
				))
				
//				->add('receptor', TextType::class, array(
//					'label' => 'Usuario',
//					'required' => 'required',
//					'attr' => array(
//						'class'=> 'form-bio form-control'
//					)
//					
//				)
//				)
				
				->add('comentario', TextareaType::class, array(
					'label' => 'Comentario',
					'required' => 'required',
					'attr' => array(
						'class'=> 'form-bio form-control'
					)
					
				)
				)
				
				->add('nota', ChoiceType::class, array(
					'label' => 'Nota',
					'required' => 'required',
					'choices'=>['1'=>1,'2'=>2,'3'=>3,'4'=>4,'5'=>5,],
					'attr' => array(
						'class'=> 'form-bio form-control'
					)
					
					
				)
				)
				
			
			
				->add('Enviar', SubmitType::class, array(
					"attr" => array(
						"class" => " btn btn-success cierra_publicacion",
						"id"=> "cierra_publicacion"
					)
				));
				
				
				
				
    }
	
	/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Comentarios'
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
