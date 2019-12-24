<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class PublicationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
				->add('tipo', ChoiceType::class, array(
					'label' => 'Tipo',
					'required' => 'required',
					'attr' => array(
						'class'=> 'form-bio form-control'
					),
					'choices'=>array(
						'Demanda'=>'Demanda',
						'Oferta'=> 'Oferta'
						
					)
					
				)
				)
				
				
				->add('asunto', TextType::class, array(
					'label' => 'Asunto',
					'required' => 'required',
					'attr' => array(
						'class'=> 'form-bio form-control'
					)
					
				)
				)
				
				
				->add('text', TextareaType::class, array(
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
				
				->add('documento', FileType::class, array(
					'label' => 'Documento ( .pdf)',
					'required' => false,
					'data_class' => null,
					'attr' => array(
						'class'=> 'form-control'
					)
					
				)
				)
				
				->add('dia_libre', DateType::class, array(
					'label' => 'Día libre',
					'required' => 'required',
					'data_class' => null,
					'format' => 'dd-MM-yyyy',
					'years' => range(2019,2020),
					
					
					'attr' => array(
						'class'=> 'form-control'
					),
					'widget' => 'choice'
					
				)
				)
				
				->add('hora_inicio', TimeType::class, array(
					'label' => 'Hora inicio',
					'required' => 'required',
					'data_class' => null,
					
					
					
					
					'attr' => array(
						'class'=> 'form-control'
					),
					'widget' => 'choice'
					
				)
				)
				
				->add('hora_fin', TimeType::class, array(
					'label' => 'Hora fin',
					'required' => 'required',
					'data_class' => null,
					
					
					'attr' => array(
						'class'=> 'form-control'
					),
					'widget' => 'choice'
					
				)
				)
				
				->add('provincia', ChoiceType::class, array(
					'label' => 'Provincia',
					'required' => 'required',
					'attr' => array(
						'class'=> 'form-bio form-control'
					),
					'choices'=>array(
						'Alava'=>'Alava',
						'Albacete'=> 'Albacete',
						'Alicante'=> 'Alicante',
						'Almería'=> 'Almería',
						'Asturias'=> 'Asturias',
						'Avila'=> 'Avila',
						'Badajoz'=> 'Badajoz',
						'Barcelona'=> 'Barcelona',
						'Burgos'=> 'Burgos',
						'Caceres'=> 'Caceres',
						'Cadiz'=> 'Cadiz',
						'Cantabria'=> 'Cantabria',
						'Castellon'=> 'Castellon',
						'Ciudad Real'=> 'Ciudad Real',
						'Cordoba'=> 'Cordoba',
						'Girona'=> 'Girona',
						'Granada '=> 'Granada ',
						'Guadalajara '=> 'Guadalajara ',
						'Guipuzcoa '=> 'Guipuzcoa ',
						'Huelva '=> 'Huelva ',
						'Huesca '=> 'Huesca ',
						'Islas Baleares'=> 'Islas Baleares',
						'Jaen '=> 'Jaen ',
						'La Coruña'=> 'La Coruña',
						'La Rioja'=> 'La Rioja',
						'Las Palmas'=> 'Las Palmas',
						'Leon'=> 'Leon',
						'Lleida'=> 'Lleida',
						'Lugo'=> 'Lugo',
						'Madrid'=> 'Madrid',
						'Malaga'=> 'Malaga',
						'Murcia'=> 'Murcia',
						'Navarra'=> 'Navarra',
						'Ourense'=> 'Ourense',
						'Pontevedra'=> 'Pontevedra',
						'Salamanca'=> 'Salamanca',
						'Segovia'=> 'Segovia',
						'Sevilla'=> 'Sevilla',
						'Soria'=> 'Soria',
						'Tarragona'=> 'Tarragona',
						'Tenerife'=> 'Tenerife',
						'Teruel'=> 'Teruel',
						'Toledo'=> 'Toledo',
						'Valencia'=> 'Valencia',
						'Valladolid'=> 'Valladolid',
						'Vizcaya'=> 'Vizcaya',
						'Zamora'=> 'Zamora',
						'Zaragoza'=> 'Zaragoza'
						
						
						
					)
					
				)
				)
				
				
				->add('Enviar', SubmitType::class, array(
					"attr" => array(
						"class" => " btn btn-success btn-login"
					)
				));
				
				
				
				
    }
	
	/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BackendBundle\Entity\Publicacion'
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
