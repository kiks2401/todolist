<?php
// src/AppBundle/Form/EditTodoType.php
namespace AppBundle\Form;

use AppBundle\Entity\Todo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class EditTodoType extends AbstractType{

    public function buildForm(FormBuilderInterface $form, array $options){
    
        $form  ->add('name', TextType::class, array('attr' => array('class' =>         
        	                 'form-control', 'style' => 'margin-bottom:15px')))

                       ->add('category', TextType::class, array('attr' => array('class' =>  'form-control', 'style' => 'margin-bottom:15px')))

                      ->add('description', TextareaType::class, array('attr' => array('class' =>  'form-control', 'style' => 'margin-bottom:15px')))

                      ->add('priority', ChoiceType::class, array('choices' => array('Low' => 'Low', 'Normal' => 'Normal', 'High' => 'High'), 'attr' => array('class' =>  'form-control', 'style' => 'margin-bottom:15px')))

                       ->add('due_date', DateTimeType::class, array('attr' => array('class' =>  'formcontrol', 'style' => 'margin-bottom:15px')))

                       //->add('save', SubmitType::class, array('label' => 'Update Todo', //'attr' => array('class' =>  'btn btn-primary', 'style' => '//margin-bottom:15px')))


                       -> getForm();



    	
    	 }

 }    	 