<?php

namespace ZHP\RokRegionowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * RokRegionow\MainBundle\Entity\User
 */
class User extends BaseUser
{

  protected $id;
  protected $email;
  protected $team;
  protected $admin;

  public function getId() { return $this->id; }
  public function setEmail($email) { $this->email = $email; }
  public function getEmail() { return $this->email; }
  public function setTeam($team) { $this->team = $team; }
  public function getTeam() { return $this->team; }
  public function getAdmin() { return $this->admin; }
  public function setAdmin($admin) { $this->admin = $admin; }

  public function isOwner($team) {
    if ($this->team == $team) return true;
    return false;
  }

  public function canEdit($team)
  {
    return $this->admin || ($this->team == $team);
  }
}