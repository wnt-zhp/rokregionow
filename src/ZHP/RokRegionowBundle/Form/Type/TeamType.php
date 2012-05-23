<?php

namespace ZHP\RokRegionowBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class TeamType extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder->add('name', 'text', array("label" => "Podaj pełną nazwę drużyny"));
    $builder->add('region', 'entity', array("label" => "Wybierz region", "class" => 'ZHPRokRegionowBundle:Region', 
      "query_builder" => function($er) {
        return $er->createQueryBuilder('r')->orderBy('r.name','ASC');
      }, "property" => "name"));
    $builder->add('short_name', 'text', array("label" => "Podaj skróconą nazwę drużyny"));
    $builder->add('troop', 'text', array("label" => "Hufiec"));
    $builder->add('squadron', 'text', array("label" => "Chorągiew"));
    $builder->add('city', 'text', array("label" => "Miasto"));
    $builder->add('street', 'text', array("label" => "Ulica", "required" => false));
    $builder->add('building', 'text', array("label" => "Budynek", "required" => false));
  }

  public function getDefaultOptions(array $options)
  {
    return array(
      'data_class' => 'ZHP\RokRegionowBundle\Entity\Team',
    );
  }

  public function getName()
  {
    return 'step';
  }
}

