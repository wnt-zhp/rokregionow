<?php

namespace ZHP\RokRegionowBundle\Tests\Model;
use ZHP\RokRegionowBundle\Entity\Team;
use Doctrine\Common\Collections\ArrayCollection;

class TeamTest extends \PHPUnit_Framework_TestCase
{
  public function testGeocode()
  {
    $team = new Team();
    $team->setCity("Lidzbark Warmiński");
    $team->setStreet("Polna");
    $team->setBuilding("36");

    $team->geocode();

    $this->assertTrue($team->getLatitude() == 54.13629);
    $this->assertTrue($team->getLongitude() == 20.587976);
  }

  public function testLocationInfo()
  {
    $team = new Team();
    $team->setName("77 Grunwaldzka Drużyna Harcerzy 'Lazaron'");
    $team->setShortName("77GDH");
    $team->setLatitude(54.13629);
    $team->setLongitude(20.587976);

    $expected = array(
      "name" => "77 Grunwaldzka Drużyna Harcerzy 'Lazaron'",
      "short_name" => "77GDH",
      "latitude" => 54.13629,
      "longitude" => 20.587976
    );

    $this->assertTrue($team->locationInfo() == $expected);
  }
}
