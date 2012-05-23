<?php

namespace ZHP\RokRegionowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use ZHP\RokRegionowBundle\Entity\Step;
use ZHP\RokRegionowBundle\Entity\Sphere;

/**
 * RokRegionow\MainBundle\Entity\Action
 */
class Action
{
    private $id;
    private $name;
    private $team;
    private $steps;
    private $sphereHistory;
    private $sphereNature;
    private $sphereLanguage;
    private $sphereCuisine;
    private $sphereFolklore;
    private $spherePlaces;
    private $sphereStereotypes;
    private $sphereCharacters;

    public function __construct()
    {
      $this->steps = new ArrayCollection();
      $this->spheres = new ArrayCollection();
    }

    public function getId() { return $this->id;}
    public function getName() { return $this->name; }
    public function setName($name) { $this->name =$name; }
    public function getTeam() { return $this->team;}
    public function setTeam($team) { $this->team = $team; }
    public function getSteps() { return $this->steps;}
    public function addStep($step) { $this->steps->add($step); $step->setAction($this);}
    public function getSphereHistory() { return $this->sphereHistory;}
    public function setSphereHistory($sphere) { $this->sphereHistory = $sphere; }
    public function getSphereNature() { return $this->sphereNature; }
    public function setSphereNature($sphere) { $this->sphereNature = $sphere; }
    public function getSphereLanguage() { return $this->sphereLanguage; }
    public function setSphereLanguage($sphere) { $this->sphereLanguage = $sphere; }
    public function getSphereFolklore() { return $this->sphereFolklore; }
    public function setSphereFolklore($sphere) { $this->sphereFolklore = $sphere; }
    public function getSpherePlaces() { return $this->spherePlaces; }
    public function setSpherePlaces($sphere) { $this->spherePlaces = $sphere; }
    public function getSphereStereotypes() { return $this->sphereStereotypes; }
    public function setSphereStereotypes($sphere) { $this->sphereStereotypes = $sphere; }
    public function getSphereCharacters() { return $this->sphereCharacters; }
    public function setSphereCharacters($sphere) { $this->sphereCharacters = $sphere; } 
    public function getSphereCuisine() { return $this->sphereCuisine; } 
    public function setSphereCuisine($sphere) { $this->sphereCuisine = $sphere; }


    public function getSpheres()
    {
      $spheres = array();
      if ($this->sphereHistory) array_push($spheres, 'historia');
      if ($this->sphereNature) array_push($spheres, 'przyroda');
      if ($this->sphereLanguage) array_push($spheres, 'język');
      if ($this->sphereCuisine) array_push($spheres, 'kulinaria');
      if ($this->sphereFolklore) array_push($spheres, 'folklor');
      if ($this->sphereCharacters) array_push($spheres, 'postacie');
      if ($this->spherePlaces) array_push($spheres, 'miejsca');
      if ($this->sphereStereotypes) array_push($spheres, 'stereotypy');
      return $spheres;
    }
}
