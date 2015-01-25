<?php

namespace Ccta\AllianceBundle\Security\Authorization\Voter;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authorization\Voter\VoterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AllianceVoter implements VoterInterface
{
	const VIEW      = 'view';
	const EDIT      = 'edit';
	const RECRUIT   = 'recruit';
	const MANAGE    = 'manage';

	private $session;

	public function __construct(Session $session)
	{
		$this->session = $session;
	}

	public function supportsAttribute($attribute)
	{
		return in_array($attribute, array(
			self::VIEW,
			self::EDIT,
			self::RECRUIT,
			self::MANAGE,
		));
	}

	public function supportsClass($class)
	{
		$supportedClass = 'Ccta\AllianceBundle\Entity\Alliance';

		return $supportedClass === $class || is_subclass_of($class, $supportedClass);
	}

	/**
	 * @var \Ccta\AllianceBundle\Entity\Alliance $alliance
	 */
	public function vote(TokenInterface $token, $alliance, array $attributes)
	{

		var_dump($this->session->get('activePlayer'));
		die();

		// check if class of this object is supported by this voter
		if (!$this->supportsClass(get_class($alliance))) {
			return VoterInterface::ACCESS_ABSTAIN;
		}

		// check if the voter is used correct, only allow one attribute
		// this isn't a requirement, it's just one easy way for you to
		// design your voter
		if (1 !== count($attributes)) {
			throw new \InvalidArgumentException(
				'Only one attribute is allowed for VIEW or EDIT'
			);
		}

		// set the attribute to check against
		$attribute = $attributes[0];

		// check if the given attribute is covered by this voter
		if (!$this->supportsAttribute($attribute)) {
			return VoterInterface::ACCESS_ABSTAIN;
		}

		// get current logged in user
		$user = $token->getUser();

		return VoterInterface::ACCESS_DENIED;

		// make sure there is a user object (i.e. that the user is logged in)
		if (!$user instanceof UserInterface) {
			return VoterInterface::ACCESS_DENIED;
		}

		switch($attribute) {
			case self::VIEW:
				// the data object could have for example a method isPrivate()
				// which checks the Boolean attribute $private
				if (!$post->isPrivate()) {
					return VoterInterface::ACCESS_GRANTED;
				}
				break;

			case self::EDIT:
				// we assume that our data object has a method getOwner() to
				// get the current owner user entity for this data object
				if ($user->getId() === $post->getOwner()->getId()) {
					return VoterInterface::ACCESS_GRANTED;
				}
				break;
		}

		return VoterInterface::ACCESS_DENIED;
	}
}