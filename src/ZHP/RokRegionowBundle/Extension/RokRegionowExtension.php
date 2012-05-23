<?php 

// RokRegionowBundle/Extension/MyTwigExtension.php
namespace ZHP\RokRegionowBundle\Extension;

class RokRegionowExtension extends \Twig_Extension
{

  protected $doctrine;

  public function __construct($doctrine)
  {
    $this->doctrine = $doctrine;
  }

  public function getFunctions()
  {
      return array(
          'regions' => new \Twig_Function_Method($this, 'regions')
      );
  }

  public function regions()
  {
    $repo = $this->doctrine->getRepository("ZHPRokRegionowBundle:Region");
    $regions = $repo->findAll();

    return $regions;
  }

  public function getName()
  {
    return 'rok_regionow_extension';
  }
}
