<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 */
class Customer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SecondName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstLastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $SecondLastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rut;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phoneNumber;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSecondName(): ?string
    {
        return $this->SecondName;
    }

    public function setSecondName(string $SecondName): self
    {
        $this->SecondName = $SecondName;

        return $this;
    }

    public function getFirstLastName(): ?string
    {
        return $this->firstLastName;
    }

    public function setFirstLastName(string $firstLastName): self
    {
        $this->firstLastName = $firstLastName;

        return $this;
    }

    public function getSecondLastName(): ?string
    {
        return $this->SecondLastName;
    }

    public function setSecondLastName(string $SecondLastName): self
    {
        $this->SecondLastName = $SecondLastName;

        return $this;
    }

    public function getRut(): ?string
    {
        return $this->rut;
    }

    public function setRut(string $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }
}
