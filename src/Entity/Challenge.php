<?php

namespace App\Entity;

use App\Repository\ChallengeRepository;
use App\Traits\TimestampableNew;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ChallengeRepository::class)
 * @ApiResource(
 *      normalizationContext={"groups"={"challenge_read"}},
 *      denormalizationContext={"groups"={"challenge_write"}}
 * )
 */
class Challenge
{
    use TimestampableNew;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"player_read", "challenge_read", "challenge_write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"player_read", "challenge_write", "challenge_read"})
     */
    private $title;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"player_read", "challenge_write", "challenge_read"})
     */
    private $score;

    /**
     * @ORM\OneToMany(targetEntity=ChallengesPlayers::class, mappedBy="challenge", orphanRemoval=true)
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

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
            $challengesPlayer->setChallenge($this);
        }

        return $this;
    }

    public function removeChallengesPlayer(ChallengesPlayers $challengesPlayer): self
    {
        if ($this->challengesPlayers->removeElement($challengesPlayer)) {
            // set the owning side to null (unless already changed)
            if ($challengesPlayer->getChallenge() === $this) {
                $challengesPlayer->setChallenge(null);
            }
        }

        return $this;
    }
}
