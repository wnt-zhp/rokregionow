<?php

namespace ZHP\RokRegionowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZHP\RokRegionowBundle\Entity\Action;
use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;

/**
 * RokRegionow\MainBundle\Entity\Team
 */
class Team
{
    private $id;

    private $name;
    private $shortName;
    private $city;
    private $street;
    private $building;
    private $actions;
    private $users;
    private $longitude;
    private $latitude;
    private $region;
    private $troop;
    private $squadron;

    public function __construct()
    {
      $this->actions = new ArrayCollection();
      $this->users = new ArrayCollection();
    }

    public function getId() { return $this->id; }
    public function setName($name) { $this->name = $name; }
    public function getName() { return $this->name; }
    public function setShortName($shortName) { $this->shortName = $shortName; }
    public function getShortName() { return $this->shortName; }
    public function setCity($city) { $this->city = $city; }
    public function getCity() { return $this->city; }
    public function getActions() { return $this->actions; }
    public function addAction($actions) { $this->actions[] = $actions; }
    public function getUsers() { return $this->users; }
    public function addUser($users) { $this->users[] = $users; }
    public function setBuilding($building) { $this->building = $building; }
    public function getBuilding() { return $this->building; }
    public function setStreet($street) { $this->street = $street; }
    public function getStreet() { return $this->street; }
    public function setLatitude($latitude) { $this->latitude = $latitude; }
    public function getLatitude() { return $this->latitude; }
    public function setLongitude($longitude) { $this->longitude = $longitude; }
    public function getLongitude() { return $this->longitude; }
    public function setRegion($region) { $this->region = $region; }
    public function getRegion() { return $this->region; }
    public function setTroop($troop) { $this->troop = $troop; }
    public function getTroop() { return $this->troop; }
    public function setSquadron($squadron) { $this->squadron = $squadron; }
    public function getSquadron() { return $this->squadron; }

    public function getSpheres() {
      $spheres = array();
      foreach ($this->actions as $action) {
        array_push($spheres, $action->getSpheres());
      }
      return array_unique($spheres);
    }

    public function geocode()
    {
      $url = $this->prepareGeocodeUrl();
      $response = json_decode(file_get_contents($url));
      $results_container = $response->results[0];
      $coord_container = $results_container->geometry;
      $location_container = $coord_container->location;

      $this->longitude = $location_container->lng;
      $this->latitude = $location_container->lat;
    }

    public function withAction()
    {
      return sizeof($this->actions) > 0;
    }

    private function prepareGeocodeUrl()
    {
      $url = "http://maps.googleapis.com/maps/api/geocode/json?language=pl&address=";
      $address = $this->building.", ".$this->street.", ".$this->city.", Polska";
      $suffix = "&sensor=false";

      return $url.urlencode($address).$suffix;
    }
}
