<?php

namespace App\Entity;

use App\Repository\OwnerRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OwnerRepository::class)
 */
class Owner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\ManyToMany(targetEntity=Chaton::class, inversedBy="owner")
     *
     */
    private $chaton_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getChatonId()
    {
        return $this->chaton_id;
    }

    public function addChatonId(Chaton $chaton_id): self
    {
        if (!$this->chaton_id->contains($chaton_id)) {
            $this->chaton_id[] = $chaton_id;
        }

        return $this;
    }

    public function removeChatonId(Chaton $chaton_id): self
    {
        $this->chaton_id->removeElement($chaton_id);

        return $this;
    }
}
