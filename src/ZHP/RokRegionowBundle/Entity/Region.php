<?php

namespace ZHP\RokRegionowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZHP\RokRegionowBundle\Entity\Action;
use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;

/**
 * RokRegionow\MainBundle\Entity\Region
 */
class Region
{
  private $id;
  private $name;
  private $slug;
  private $teams;

  public function __construct()
  {
    $this->teams = new ArrayCollection();
  }

  public function getId() { return $this->id; }
  public function setName($name) { $this->name = $name; }
  public function getName() { return $this->name; }
  public function setSlug($slug) { $this->slug = $slug; }
  public function getSlug() { return $this->slug; }
  public function getTeams() { return $this->teams; }
  public function addTeam($teams) { $this->teams[] = $teams; }

}