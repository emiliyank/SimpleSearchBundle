<?php
// src/Emo/SimpleSearchBundle/Form/Type/SearchContentType.php

namespace Emo\SimpleSearchBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
* This is an Abstract class that is responsible for the search form
*/
class SearchContentType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('searchContent', TextType::class, array('label'=> 'Search Content:* '))
            ->add('fileType', TextType::class , array('label'=> 'File Type:'))
            ->add('searchDir',  ChoiceType::class, array(
            	'label' => 'Search Path:',
            	'choices' => $options['dirs_list'],
            	'choices_as_values' => true))
            ->add('save', SubmitType::class, array('label' => 'Search for File'));
    }

    public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setRequired(array(
	        'dirs_list',
	    ));

	    $resolver->setDefaults(array(
	        'data_class' => 'Emo\SimpleSearchBundle\Entity\FileSearch',
	        'dirs_list' => null,
	    ));
	}
}