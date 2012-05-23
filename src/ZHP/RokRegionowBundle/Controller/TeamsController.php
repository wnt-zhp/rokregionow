<?php

namespace ZHP\RokRegionowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use ZHP\RokRegionowBundle\Entity\Team;
use ZHP\RokRegionowBundle\Form\Type\TeamType;

class TeamsController extends Controller
{

  public function indexAction()
  {
    $teams = $this->getRepo()->findAll();
    return $this->render('ZHPRokRegionowBundle:Teams:index.html.twig', array("teams" => $teams));
  }

  public function showAction($slug)
  {
    $team = $this->getTeam($slug);
    $actions = $team->getActions();
    return $this->render('ZHPRokRegionowBundle:Teams:show.html.twig', array("team" => $team, "actions" => $actions));
  }

  public function createAction()
  {
    $team = new Team();
    $em = $this->get('doctrine')->getEntityManager(); 
    $form = $this->createForm(new TeamType(), $team);
    $request = $this->get('request');

    $this->checkUser($team);

    if ($request->getMethod() == 'POST')
    {
      $form->bindRequest($request);
      if($form->isValid()) { 
        $team = $form->getData(); 
        $em->persist($team); 
        $em->flush(); 

        return $this->redirect($this->generateUrl('team_show', array("slug" => $team->getShortName())));
      }
    }

    return $this->render('ZHPRokRegionowBundle:Teams:new.html.twig', 
      array("form" => $form->createView(), "team" => $team));
  }

  public function updateAction($slug)
  {
    $team = $this->getTeam($slug);
    $em = $this->get('doctrine')->getEntityManager(); 
    $form = $this->createForm(new TeamType(), $team);
    $request = $this->get('request');

    $this->checkUser($team);

    if ($request->getMethod() == 'POST')
    {
      $form->bindRequest($request);
      if($form->isValid()) { 
        $team = $form->getData(); 
        $em->persist($team); 
        $em->flush(); 

        return $this->redirect($this->generateUrl('team_show', array("slug" => $slug)));
      }
    }

    return $this->render('ZHPRokRegionowBundle:Teams:edit.html.twig', 
      array("form" => $form->createView(), "team" => $team));
  }

  public function locationsAction()
  {
    $result = $this->getDoctrine()->getConnection()->fetchAll("
      select t.name, t.latitude, t.longitude, t.shortname,
      max(a.sphereHistory) as historia,
      max(a.sphereFolklore) as folklor,
      max(a.sphereNature) as przyroda,
      max(a.sphereCharacters) as postacie,
      max(a.sphereCuisine) as kuchnia,
      max(a.sphereLanguage) as język,
      max(a.sphereStereotypes) as stereotypy,
      max(a.spherePlaces) as miejsca
      from team t left join action a on t.id = a.team_id group by t.id;
      ");
    return new Response(json_encode($result), 200);
  }

//===========
//private
//===========

  private function getTeam($slug)
  {
    $team = $this->getRepo()->findOneByShortName($slug);

    if(!$team) {
      throw $this->createNotFoundException('No team found for id '.$slug);
    }

    return $team;
  }

  private function checkUser($team)
  {
    $user= $this->get('security.context')->getToken()->getUser();
    if (!$user || !$user->canEdit($team))
    {
      throw $this->createNotFoundException('You cannot edit this team');
    }
    return true;
  }

  private function getRepo()
  {
    return $this->getDoctrine()->getRepository("ZHPRokRegionowBundle:Team");
  }
}
