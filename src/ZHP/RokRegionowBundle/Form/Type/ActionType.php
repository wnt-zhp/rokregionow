<?php 

namespace ZHP\RokRegionowBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ActionType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', null, array("label" => "Tytuł akcji"));
        $builder->add('sphereHistory', null, array("required" => false, "label" => "historia"));
        $builder->add('sphereNature', null, array("required" => false, "label" => "przyroda"));
        $builder->add('sphereLanguage', null, array("required" => false, "label" => "język"));
        $builder->add('sphereFolklore', null, array("required" => false, "label" => "folklor"));
        $builder->add('sphereCharacters', null, array("required" => false, "label" => "postacie"));
        $builder->add('sphereStereotypes', null, array("required" => false, "label" => "stereotypy"));
        $builder->add('spherePlaces', null, array("required" => false, "label" => "miejsca"));
        $builder->add('sphereCuisine', null, array("required" => false, "label" => "kulinaria"));
        $builder->add('steps', 'collection', array('type' => new StepType(), "label" => "Kroki"));
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'ZHP\RokRegionowBundle\Entity\Action',
        );
    }

    public function getName()
    {
        return 'action';
    }
}
