<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use App\Traits\TimestampableNew;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @ORM\Entity(repositoryClass=PlayerRepository::class)
 * @ApiResource(
 *      normalizationContext={"groups"={"player_read"}},
 *      denormalizationContext={"groups"={"player_write"}}
 * )
 * @UniqueEntity("name")
 */

class Player
{
    use TimestampableNew;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"player_read", "player_write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"player_read", "player_write"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ChallengesPlayers::class, mappedBy="player", orphanRemoval=true)
     * @Groups({"player_read"})
     */
    private $challengesPlayers;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->challengesPlayers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ChallengesPlayers[]
     */
    public function getChallengesPlayers(): Collection
    {
        return $this->challengesPlayers;
    }

    public function addChallengesPlayer(ChallengesPlayers $challengesPlayer): self
    {
        if (!$this->challengesPlayers->contains($challengesPlayer)) {
            $this->challengesPlayers[] = $challengesPlayer;
            $challengesPlayer->setPlayer($this);
        }

        return $this;
    }

    public function removeChallengesPlayer(ChallengesPlayers $challengesPlayer): self
    {
        if ($this->challengesPlayers->removeElement($challengesPlayer)) {
            // set the owning side to null (unless already changed)
            if ($challengesPlayer->getPlayer() === $this) {
                $challengesPlayer->setPlayer(null);
            }
        }

        return $this;
    }
}
