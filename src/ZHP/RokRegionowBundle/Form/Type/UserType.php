<?php

namespace ZHP\RokRegionowBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class UserType extends AbstractType
{
  public function buildForm(FormBuilder $builder, array $options)
  {
    $builder->add('email', 'text');
    $builder->add('plain_password', 'password', array("label" => "Podaj hasło"));
    $builder->add('team', 'entity', array("label" => "Wybierz drużynę", "class" => 'ZHPRokRegionowBundle:Team', "empty_value" => false,
      "query_builder" => function($er) {
        return $er->createQueryBuilder('t')->orderBy('t.name','ASC');
      }, "property" => "name"));
  }

  public function getDefaultOptions(array $options)
  {
    return array(
      'data_class' => 'ZHP\RokRegionowBundle\Entity\User',
    );
  }

  public function getName()
  {
    return 'user';
  }
}
