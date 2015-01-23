<?php
// src/Ccta/MessageBundle/Entity/ThreadMetadata.php

namespace Ccta\MessageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\ThreadMetadata as BaseThreadMetadata;

/**
 * @ORM\Table(name="ccta_message_thread_metadata")
 * @ORM\Entity
 */
class ThreadMetadata extends BaseThreadMetadata
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(
	 *   targetEntity="Ccta\MessageBundle\Entity\Thread",
	 *   inversedBy="metadata"
	 * )
	 * @var \FOS\MessageBundle\Model\ThreadInterface
	 */
	protected $thread;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\UserBundle\Entity\User")
	 * @var \FOS\MessageBundle\Model\ParticipantInterface
	 */
	protected $participant;
}