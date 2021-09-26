<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ChallengesPlayersRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Traits\TimestampableNew;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ChallengesPlayersRepository::class)
 * @ApiResource(
 *      normalizationContext={"groups"={"chall_player_read"}},
 *      denormalizationContext={"groups"={"chall_player_write"}}
 * )
 */
class ChallengesPlayers
{
    use TimestampableNew;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"chall_player_read", "player_read"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Player::class, inversedBy="challengesPlayers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"chall_player_read", "chall_player_write"})
     */
    private $player;

    /**
     * @ORM\ManyToOne(targetEntity=Challenge::class, inversedBy="challengesPlayers")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"chall_player_read", "chall_player_write", "player_read"})
     */
    private $challenge;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer(): ?Player
    {
        return $this->player;
    }

    public function setPlayer(?Player $player): self
    {
        $this->player = $player;

        return $this;
    }

    public function getChallenge(): ?Challenge
    {
        return $this->challenge;
    }

    public function setChallenge(?Challenge $challenge): self
    {
        $this->challenge = $challenge;

        return $this;
    }
}
