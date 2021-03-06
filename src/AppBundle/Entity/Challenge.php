<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Challenge
 *
 * @ORM\Table(name="challenge")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChallengeRepository")
 */
class Challenge
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank(message="Please enter a title")
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var int
     *
     * @ORM\Column(name="nbPoints", type="integer")
     * @Assert\NotBlank(message="Please enter a number of points")
     */
    protected $nbPoints;

    /**
     * @var bool
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Score", mappedBy="challenge")
     * @ORM\OrderBy({"nbTimes" = "DESC"})
     */
    protected $scores;

    /**
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Game", inversedBy="game")
    * @ORM\JoinColumn(nullable=false)
    */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    protected $createdBy;

    /**
     * Constructor
     */
    public function __construct() {
        $this->scores = new \Doctrine\Common\Collections\ArrayCollection();
        $this->setDeleted(false);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets the title of this challenge
     *
     * @param string $title
     * @return Challenge
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title the title of this challenge
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Challenge
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Sets the number of points this challenge is worth
     *
     * @param integer $nbPoints
     * @return Challenge
     */
    public function setNbPoints($nbPoints) {
        $this->nbPoints = $nbPoints;
        return $this;
    }

    /**
     * Returns the number of points this challenge is worth
     *
     * @return integer
     */
    public function getNbPoints() {
        return $this->nbPoints;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return Challenge
     */
    public function setDeleted($deleted) {
        $this->deleted = $deleted;
        return $this;
    }

    /**
     * Indicates if this challenge was deleted or not
     *
     * @return boolean
     */
    public function isDeleted() {
        return $this->deleted;
    }

    /**
     * Add score
     *
     * @param \AppBundle\Entity\Score $score
     * @return Challenge
     */
    public function addScore(\AppBundle\Entity\Score $score) {
        $score->setChallenge($this);
        $this->scores[] = $score;
        return $this;
    }

    /**
     * Removes a score from the score list
     *
     * @param \AppBundle\Entity\Score $score
     */
    public function removeScore(\AppBundle\Entity\Score $score) {
        $this->scores->removeElement($score);
    }

    /**
     * Get scores
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getScores() {
        return $this->scores;
    }

    /**
     * Set game
     *
     * @param \AppBundle\Entity\Game $game
     * @return Challenge
     */
    public function setGame(\AppBundle\Entity\Game $game) {
        $this->game = $game;
        return $this;
    }

    /**
     * Get game
     *
     * @return \AppBundle\Entity\Game 
     */
    public function getGame() {
        return $this->game;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     *
     * @return Challenge
     */
    public function setCreatedBy(\AppBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
}
