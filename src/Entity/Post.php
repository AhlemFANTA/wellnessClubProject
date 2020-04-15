<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity()
 * @ORM\Table(name="post")
 * */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length( min = 10, max = 70, minMessage = "Ce titre est trop court",  maxMessage = "Ce titre est trop long" )
     */
    public $titre;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message = "Le contenu ne peut être vide.")
     */
    public $auteur;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message = "Un auteur doit être associé à l'article")
     */
    public $contenu;

    /**
     * @ORM\Column(type="datetime", name="date")
     */
    public $date;


    /**
     * @ORM\Column(type="string")
     */
    private $picFilename;

    public function getPicFilename()
    {
        return $this->picFilename;
    }

    public function setPicFilename($picFilename)
    {
        $this->picFilename = $picFilename;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur): void
    {
        $this->auteur = $auteur;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu): void
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }


}