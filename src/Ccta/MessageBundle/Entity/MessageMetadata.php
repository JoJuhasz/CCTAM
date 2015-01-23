<?php
// src/Ccta/MessageBundle/Entity/MessageMetadata.php

namespace Ccta\MessageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\MessageMetadata as BaseMessageMetadata;

/**
 * @ORM\Table(name="ccta_message_message_metadata")
 * @ORM\Entity
 */
class MessageMetadata extends BaseMessageMetadata
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(
	 *   targetEntity="Ccta\MessageBundle\Entity\Message",
	 *   inversedBy="metadata"
	 * )
	 * @var \FOS\MessageBundle\Model\MessageInterface
	 */
	protected $message;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\UserBundle\Entity\User")
	 * @var \FOS\MessageBundle\Model\ParticipantInterface
	 */
	protected $participant;
}