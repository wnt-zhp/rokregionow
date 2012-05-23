<?php
// src/ZHP/RokRegionowBundle/DataFixtures/ORM/LoadSphereData.php
namespace ZHP\RokRegionowBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use ZHP\RokRegionowBundle\Entity\User;
use ZHP\RokRegionowBundle\Entity\Team;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use FOS\UserBundle\Entity\UserManager;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{

    private $container;

    public function load(ObjectManager $manager)
    {
      $this->manager = $manager;
      $container = $this->container;
      $userManager = $container->get('fos_user.user_manager');
      $this->createUsers($userManager);
      $this->createAdmins($userManager);
      $this->createSingleUser($userManager);
    }

    private function createSingleUser($manager)
    {
      $user = $manager->createUser();
      $user->setEmail("iamanuser@example.com");
      $user->setUserName("iamanuser@example.com");
      $user->setPlainPassword("iamanuser");
      $user->setEnabled(true);
      $manager->updateUser($user);
    }

    public function setContainer(ContainerInterface $container = null)
    {
      $this->container = $container;
    }

    private function createAdmins($manager)
    {
      $data = $this->adminsData();

      foreach($data as $email)
      {
        $username = preg_replace('/@.+/', '', $email);
        $user = $manager->createUser();
        $user->setEmail($email);
        $user->setUserName($username);
        $user->setPlainPassword($username);
        $user->setAdmin(true);
        $user->setEnabled(true);
        $manager->updateUser($user);
      }
    }

    private function createUsers($manager)
    {
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

      while(($line = fgetcsv($csv,1000,",")) !== FALSE)
      {

        if (sizeof($line) <= 8)
        {
          echo "Wrong line!";
          continue;
        }

        echo $line[1]."\n";
        $team = $this->findTeam($line[1]);
        $email = $line[5];

        $username = preg_replace('/@.+/', '', $email);
        $user = $manager->createUser();
        $user->setEmail($email);
        $user->setUserName($username);
        $user->setPlainPassword($username);
        $user->setEnabled(true);
        $user->setTeam($team);
        $manager->updateUser($user);

      }
    }

    private function adminsData()
    {
      return array(
        "iamadmin@example.com"
      );
    }

    private function findTeam($name)
    {
      $repository = $this->manager->getRepository("ZHPRokRegionowBundle:Team");
      $team = $repository->findOneByName($name);
      return $team;
    }
}

