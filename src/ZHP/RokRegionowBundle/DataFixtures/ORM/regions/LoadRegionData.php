<?php
// src/ZHP/RokRegionowBundle/DataFixtures/ORM/LoadRegionData.php
namespace ZHP\RokRegionowBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use ZHP\RokRegionowBundle\Entity\Region;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRegionData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
      $data = $this->regionsData();

      foreach($data as $slug => $name)
      {
        $region = new Region();

        $region->setName($name);
        $region->setSlug($slug);

        $manager->persist($region);
        $manager->flush();
      }

    }

    private function regionsData()
    {
      return array(
        "bieszczady" => "Bieszczady",
        "dolny-rzeki-orli" => "Dolina rzeki Orli",
        "dolny-slask" => "Dolny Śląsk",
        "gorne-luzyce" => "Górne Łużyce",
        "gorny-slask" => "Górny Śląsk",
        "jura-krakowsko-czestochowska" => "Jura Krakowsko-Częstochowska",
        "kaszuby" => "Kaszuby",
        "kielecczyzna" => "Kielecczyzna",
        "kociewie" => "Kociewie",
        "kozla" => "Kozła",
        "kraina-dolnego-sanu" => "Kraina Dolnego Sanu",
        "krajna" => "Krajna",
        "kujawy" => "Kujawy",
        "kurpie-biale" => "Kurpie Białe",
        "kurpie-zielone" => "Kurpie Zielone",
        "lodz" => "Łódź",
        "lowicke" => "Łowickie",
        "lubelszczyzna" => "Lubelszczyzna",
        "malopolska" => "Małopolska",
        "malopolska-zachodnia" => "Małopolska Zachodnia",
        "mazowsze" => "Mazowsze",
        "mazury" => "Mazury",
        "mazury-zachodnie" => "Mazury Zachodnie",
        "opolszczyzna" => "Opolszczyzna",
        "paluki" => "Pałuki",
        "podbeskidzie" => "Podbeskidzie",
        "podhale" => "Podhale",
        "podkarpacie" => "Podkarpacie",
        "podlasie" => "Podlasie",
        "pomorze-srodkowe" => "Pomorze Środkowe",
        "pomorze-zachodnie" => "Pomorze Zachodnie",
        "powisle" => "Powiśle",
        "radomski" => "Radomski",
        "suwalszczyzna" => "Suwalszczyzna",
        "warmia" => "Warmia",
        "warszawa" => "Warszawa",
        "wielkopolska" => "Wielkopolska",
        "zaglebie-dabrowskie" => "Zagłębie Dąbrowskie",
        "zamojszczyzna" => "Zamojszczyzna",
        "ziemia-chelminska" => "Ziemia Chełmińska",
        "ziemia-dobrzynska" => "Ziemia Dobrzyńska",
        "ziemia-klodzka" => "Ziemia Kłodzka",
        "ziemia-leczycka" => "Ziemia Łęczycka",
        "ziemia-lubawska" => "Ziemia Lubawska",
        "ziemia-lubuska" => "Ziemia Lubuska",
        "ziemia-lomzynska" => "Ziemia Łomżyńska",
        "ziemia-nyska" => "Ziemia Nyska",
        "ziemia-prudnicka" => "Ziemia Prudnicka",
        "ziemia-sieradzka" => "Ziemia Sieradzka",
        "ziemia-wielunska" => "Ziemia Wieluńska",
        "ziemia-zawkrzenska" => "Ziemia Zawkrzeńska",
        "zulawy" => "Żuławy",
      );
    }
}
