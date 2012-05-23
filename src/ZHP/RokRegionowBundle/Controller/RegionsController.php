<?php

namespace ZHP\RokRegionowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use ZHP\RokRegionowBundle\Entity\Region;
use ZHP\RokRegionowBundle\Entity\Team;

class RegionsController extends Controller
{
  public function indexAction()
  {
    $teams = $this->getRepo()->findAll();
    return $this->render('ZHPRokRegionowBundle:Teams:index.html.twig', array("teams" => $teams));
  }

  public function showAction($slug)
  {
    $region = $this->getRepo()->findOneBySlug($slug);

    if(!$region) {
      throw $this->createNotFoundException('No team found for id '.$slug);
    }

    return $this->render('ZHPRokRegionowBundle:Regions:show.html.twig', array("region" => $region));
  }

  private function getRepo()
  {
    return $this->getDoctrine()->getRepository("ZHPRokRegionowBundle:Region");
  }

}
