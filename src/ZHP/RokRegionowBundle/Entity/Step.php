<?php

namespace ZHP\RokRegionowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection as ArrayCollection;
use ZHP\RokRegionowBundle\Entity\Action;
use ZHP\RokRegionowBundle\Entity\Photo;

/**
 * RokRegionow\MainBundle\Entity\Step
 */
class Step
{
  private $id;
  private $description;
  private $movie;
  private $photos;
  private $action;
  private $documents;

  public function __construct()
  {
    $this->photos = new ArrayCollection();
    $this->documents = new ArrayCollection();
  }

  public function getId() { return $this->id; }
  public function getDescription() { return $this->description; }
  public function setDescription($description) { $this->description = $description; }
  public function getMovie() { return $this->movie; }
  public function setMovie($movie) { $this->movie = $movie; }
  public function setAction($action) { $this->action = $action; }
  public function getAction() { return $this->action; }
  public function setPhotos($photos) { $this->photos = $photos; }
  public function addPhoto($photo) { $this->photos->add($photo); $photo->setStep($this); }
  public function getPhotos() { return $this->photos; }
  public function setDocuments($documents) { $this->documents = $documents; }
  public function addDocument($document) { $this->documents->add($document); $document->setStep($this); }
  public function getDocuments() { return $this->documents; }

  public function correctMovie()
  {
    if ($this->movie == "") return;
    preg_match("/(\/|=)[A-Za-z0-9_-]+$/", $this->movie, $movie_code);
    $movie_code = str_replace("=","/",$movie_code[0]);

    $correct_link = "http://youtube.com/embed".$movie_code;

    $this->movie = $correct_link;
  }

}
