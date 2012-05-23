<?php
// src/ZHP/RokRegionowBundle/DataFixtures/ORM/LoadRegionData.php
namespace ZHP\RokRegionowBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use ZHP\RokRegionowBundle\Entity\Team;
use ZHP\RokRegionowBundle\Entity\Region;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTeamData implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    $this->manager = $manager;

    $csv = fopen("src/ZHP/RokRegionowBundle/DataFixtures/ORM/rr.csv","r");
    // 0 - timestamp
    // 1 - name
    // 2 - troop
    // 3 - city
    // 4 - squadron
    // 5 - email
    // 6 - second email
    // 7 - mobile
    // 8 - region
    // rest - not important

    $line = fgetcsv($csv, 1000, ",");
    $shortNames = array();

    while(($line = fgetcsv($csv,1000,",")) !== FALSE)
    {

      if (sizeof($line) <= 8)
      {
        echo "Wrong line!";
        continue;
      }

      $team = new Team();

      $region = $this->findRegion($line[8]);

      $shortName = strtoupper($this->findShortName($line[1]));

      if (in_array($shortName, $shortNames)) {
        $shortName = uniqid('');
      }
      array_push($shortNames, $shortName);

      $team->setName($line[1]);
      $team->setShortName($shortName);
      $team->setSquadron($line[4]);
      $team->setTroop($line[2]);
      $team->setRegion($region);
      $team->setCity($line[3]);

      $manager->persist($team);
      $manager->flush();
    }
  }


  private function findShortName($name)
  {
    $basicName = preg_replace('/("|im\.).+/','',$name);
    $words = explode(" ", $basicName);
    $shortName = "";

    foreach($words as $word) {
      if (preg_match('/\d+.*/', $word, $num)) {
        $shortName = $shortName.$num[0];
      } else {
        $shortName = $shortName.mb_substr($word, 0, 1, 'UTF-8');
      }
    }
    return $shortName;
  }

  private function findRegion($name)
  {
    $repository = $this->manager->getRepository("ZHPRokRegionowBundle:Region");
    $region = $repository->findOneByName($name);
    return $region;
  }

}
