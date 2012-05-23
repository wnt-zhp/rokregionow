<?php

namespace ZHP\RokRegionowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ZHP\RokRegionowBundle\Entity\Team;
use ZHP\RokRegionowBundle\Entity\Action;
use ZHP\RokRegionowBundle\Entity\Step;
use ZHP\RokRegionowBundle\Entity\Photo;
use ZHP\RokRegionowBundle\Entity\Document;
use ZHP\RokRegionowBundle\Form\Type\ActionType;

class ActionsController extends Controller
{

  public function createAction($slug)
  {
    $team = $this->getTeam($slug);
    $this->checkUser($team);

    $action = new Action();

    for($i=1; $i<=2; $i++)
    {
      $step = new Step();
      $step->addDocument(new Document());
      $action->addStep($step);
    }

    $form = $this->createForm(new ActionType(), $action);
    $em = $this->get('doctrine')->getEntityManager(); 
    $request = $this->get('request');

    if ($request->getMethod() == 'POST')
    {
      $form->bindRequest($request);
      if($form->isValid()) {
        $action->setTeam($team);
        $steps = $action->getSteps();
        foreach($steps as $step) 
        {
          foreach($step->getPhotos() as $photo)
          {
            $photo->setStep($step);
          }
        }

        $em->persist($action); 
        $em->flush(); 

        return $this->redirect($this->generateUrl('team_action_show', 
          array("slug" => $slug, "id" => $action->getId())));
      }
    } 
    return $this->render('ZHPRokRegionowBundle:Actions:new.html.twig', 
      array("form" => $form->createView(), "team" => $team, "action" => $action));
  }

  public function updateAction($slug, $id)
  {
    $team = $this->getTeam($slug);
    $this->checkUser($team);
    $action = $this->getAction($team, $id);
    $em = $this->get('doctrine')->getEntityManager(); 
    $form = $this->createForm(new ActionType(), $action);
    $request = $this->get('request');

    if ($request->getMethod() == 'POST') {

      $form->bindRequest($request);
      if($form->isValid()) { 
        $steps = $action->getSteps();
        foreach ($steps as $step)
        {
          $photos = $step->getPhotos();
          foreach($photos as $photo)
          {
            $photo->setStep($step);
          }
        }
        $em->persist($action); 
        $em->flush(); 
        return $this->redirect($this->generateUrl('team_action_show', array("slug" => $slug, "id" => $action->getId())));
      }
    }
    return $this->render('ZHPRokRegionowBundle:Actions:edit.html.twig', 
      array("form" => $form->createView(), "team" => $team, "action" => $action));
  }

  public function showAction($slug, $id)
  {
    $team = $this->getTeam($slug);
    $action = $this->getAction($team, $id);

    return $this->render('ZHPRokRegionowBundle:Actions:show.html.twig', 
      array("team" => $team, "action" => $action));
  }

  public function deleteAction($slug, $id)
  {
    $team = $this->getTeam($slug);
    $this->checkUser($team);
    $action = $this->getAction($team, $id);
    $em = $this->get('doctrine')->getEntityManager();
    $em->remove($action);
    $em->flush(); 

    return $this->redirect($this->generateUrl('team_show', array("slug" => $slug)));
  }

//===========
//private
//===========
  private function getRepo()
  {
    return $this->getDoctrine()->getRepository("ZHPRokRegionowBundle:Action");
  }

  private function getTeamRepo()
  {
    return $this->getDoctrine()->getRepository("ZHPRokRegionowBundle:Team");
  }

  private function getTeam($slug)
  {
    $team = $this->getTeamRepo()->findOneByShortName($slug);

    if(!$team) {
      throw $this->createNotFoundException('No team found for id '.$slug);
    }

    return $team;
  }

  private function getAction($team, $id)
  {
    $action = $this->getRepo()->findOneById($id);

    if($action->getTeam() != $team) {
      throw $this->createNotFoundException('Wrong action id for team '.$team->getShortName());
    }

    return $action;
  }

  private function checkUser($team)
  {
    $user= $this->get('security.context')->getToken()->getUser();
    if (!$user || !$user->canEdit($team))
    {
      #TODO change error type
      throw $this->createNotFoundException('You cannot edit this team');
    }
    return true;
  }
}
