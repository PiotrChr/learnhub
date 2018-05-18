<?php

namespace LearnHub\MainApp\MainAppBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Avanzu\AdminThemeBundle\Model\UserInterface as AvancuUserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraint as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="LearnHub\MainApp\MainAppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity(
 *     fields={"username"},
 *     message="This username is already taken"
 * )
 * */
class User implements UserInterface, AvancuUserInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * */
    protected $id;

    /**
     * @ORM\Column(type="string",length=100)
     * */
    protected $password;

    /**
     * @ORM\Column(type="string",length=255, unique=true)
     * */
    protected $username;

//    /**
//     * @Assert\Length(max=4096)
//     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="integer")
     * */
    protected $initialRank;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $role;

    /**
     * @ORM\ManyToOne(targetEntity="AccessLevel", inversedBy="users")
     * @ORM\JoinColumn(name="access_level", referencedColumnName="id")
     * */
    protected $accessLevel;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $activationToken;

    /**
     * @ORM\Column(type="boolean", options={"default" = 0})
     */
    protected $isActive;

    /**
     * @ORM\OneToMany(targetEntity="LearnHub\MainApp\MainAppBundle\Entity\Rank", mappedBy="user")
     * */
    protected $ranks;

    /**
     * @ORM\OneToOne(targetEntity="LearnHub\MainApp\MainAppBundle\Entity\Image")
     * @ORM\JoinColumn(name="avatar_id", referencedColumnName="id")
     */
    protected $avatar;


    public function _construct() {
        $this->isActive = true;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set accessLevel
     *
     * @param AccessLevel $accessLevel
     *
     * @return User
     */
    public function setAccessLevel(AccessLevel $accessLevel)
    {
        $this->accessLevel = $accessLevel;

        return $this;
    }

    /**
     * Get accessLevel
     *
     * @return integer
     */
    public function getAccessLevel()
    {
        return $this->accessLevel;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */

    public function getRoles() {
        return [$this->role];
    }

    public function getRole() {
        return $this->role;
    }


    public function setRole($role) {
        $this->role = $role;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt() {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */

    public function eraseCredentials() {
        return null;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = unserialize($serialized);
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return true;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getName()
    {
        return $this->username;
    }

    public function getMemberSince()
    {
        return true;
    }

    public function isOnline()
    {
        return true;
    }

    public function getIdentifier()
    {
        // TODO: Implement getIdentifier() method.
    }

    public function getTitle()
    {
        return 'Mr. ';
    }

    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return mixed
     */
    public function getActivationToken()
    {
        return $this->activationToken;
    }

    /**
     * @param mixed $activationToken
     */
    public function setActivationToken($activationToken)
    {
        $this->activationToken = $activationToken;
    }

    /**
     * @return mixed
     */
    public function getInitialRank()
    {
        return $this->initialRank;
    }

    /**
     * @param mixed $initialRank
     */
    public function setInitialRank($initialRank)
    {
        $this->initialRank = $initialRank;
    }

    /**
     * @return mixed
     */
    public function getRanks()
    {
        return $this->ranks;
    }

    /**
     * @param mixed $ranks
     */
    public function setRanks($ranks)
    {
        $this->ranks = $ranks;
    }

    public function getOverallRank() {

        $overall = 0;
        foreach ($this->ranks as $rank) {
            /** @var $rank Rank**/
            $overall += $rank->getRank();
        }

        return $this->initialRank + $overall;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }


}
