<?php

namespace ZHP\RokRegionowBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class DocumentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('file','file', array("label" => "plik PDF", "required" => false));
        $builder->add('ischanged', 'hidden', array("required" => false));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'ZHP\RokRegionowBundle\Entity\Document',
        );
    }

    public function getName()
    {
        return 'document';
    }
}


