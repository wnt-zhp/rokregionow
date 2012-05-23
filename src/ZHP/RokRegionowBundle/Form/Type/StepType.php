<?php

namespace ZHP\RokRegionowBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class StepType extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder->add('description', 'textarea', 
      array("required" => false, "label" => "Opis kroku", "max_length" => 5000));
    $builder->add('movie', 'text', 
      array("required" => false, "label" => "Link do filmu (film musi być umieszczony w serwisie Youtube)"));
    $builder->add('photos', 'collection', 
      array('type' => new PhotoType(), "label" => "Zdjęcia", 
      "allow_add" => true, "allow_delete" => true));
    $builder->add('documents','collection', 
      array('type' => new DocumentType(), "label" => "Wybierze plik PDF z dysku"));
  }

  public function getDefaultOptions(array $options)
  {
    return array(
      'data_class' => 'ZHP\RokRegionowBundle\Entity\Step',
    );
  }

  public function getName()
  {
    return 'step';
  }
}
