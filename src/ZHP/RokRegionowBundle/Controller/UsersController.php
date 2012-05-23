<?php

namespace ZHP\RokRegionowBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use ZHP\RokRegionowBundle\Entity\User;
use ZHP\RokRegionowBundle\Form\Type\UserType;
use FOS\UserBundle\Entity\UserManager;

class UsersController extends Controller
{

  public function createAction()
  {
    $manager = $this->get('fos_user.user_manager');
    $user = $manager->createUser();
    $form = $this->createForm(new UserType(), $user);
    $request = $this->get('request');

    $this->checkUser();

    if ($request->getMethod() == 'POST')
    {
      $form->bindRequest($request);
      if($form->isValid()) { 

        $user->setEnabled(true);
        $username = preg_replace('/@.+/', '', $user->getEmail());
        $user->setUserName($username);
        $manager->updateUser($user);

        return $this->redirect($this->generateUrl('team_show', array("slug" => $user->getTeam()->getShortName())));
      }
    }

    return $this->render('ZHPRokRegionowBundle:Users:new.html.twig', 
      array("form" => $form->createView()));
  }

  private function checkUser()
  {
    $currentUser= $this->get('security.context')->getToken()->getUser();
    if (!$currentUser || !$currentUser->getAdmin())
    {
      throw $this->createNotFoundException('This page does not exist');
    }
    return true;
  }
}
