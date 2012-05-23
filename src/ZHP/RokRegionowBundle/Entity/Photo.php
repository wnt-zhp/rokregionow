<?php

namespace ZHP\RokRegionowBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RokRegionow\MainBundle\Entity\Photo
 */
class Photo
{
  public $file;
  protected $id;
  protected $name;
  protected $description;
  protected $path;
  protected $step;
  protected $isChanged;

  public function getId() { return $this->id; }
  public function setName($name) { $this->name = $name; }
  public function getName() { return $this->name; }
  public function setDescription($description) { $this->description = $description; }
  public function getDescription() { return $this->description; }
  public function setPath($path) { $this->path = $path; }
  public function getPath() { return $this->path; }
  public function getStep() { return $this->step; }
  public function setStep($step) { $this->step = $step; }
  public function getIsChanged() { return $this->isChanged; }
  public function setIsChanged($isChanged) { $this->isChanged = $isChanged; }

  public function getAbsolutePath()
  {
    return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->id.'.'.$this->path;
  }

  public function getWebPath()
  {
    return null === $this->path ? null : $this->getUploadDir().'/'.$this->id.'.'.$this->path;
  }

  public function resetIsChanged()
  {
    $this->isChanged = false;
  }

  public function preUpload()
  {
    if (null !== $this->file) {
      $this->path = $this->file->guessExtension();
    }
  }

  public function upload()
  {
    if (null === $this->file) return;

    $this->file->move($this->getUploadRootDir(), $this->id.'.'.$this->file->guessExtension());
    unset($this->file);
  }

  public function removeUpload()
  {
    if ($file = $this->getAbsolutePath()) unlink($file);
  }

  protected function getUploadRootDir()
  {
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
  }

  protected function getUploadDir()
  {
    return 'uploads/photos';
  }
}
