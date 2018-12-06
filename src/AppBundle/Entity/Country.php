<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Table(name="countrys")
* @ORM\Entity
*/
class Country
{
    /**
    * @var integer $id
    *
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;

    /**
    * @var string $name
    *
    * @ORM\Column(name="name", type="string", length=100, nullable=false)
    */
    private $name;

    /**
    * @var datetime $created_at
    *
    * @ORM\Column(name="created_at", type="datetime")
    */
    private $created_at;

    /**
    * @var datetime $updated_at
    *
    * @ORM\Column(name="updated_at", type="datetime")
    */
    private $updated_at;
}