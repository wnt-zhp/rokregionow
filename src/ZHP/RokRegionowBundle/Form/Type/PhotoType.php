<?php

namespace ZHP\RokRegionowBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('file','file', array("label" => "Wybierz zdjęcie z dysku", "required" => false));
        $builder->add('name', 'text', array("label" => "Wpisz tytuł zdjęcia", "required" => false));
        $builder->add('description', 'textarea', array("label" => "opis", "required" => false));
        $builder->add('ischanged', 'hidden', array("required" => false));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'ZHP\RokRegionowBundle\Entity\Photo',
        );
    }

    public function getName()
    {
        return 'photo';
    }
}

