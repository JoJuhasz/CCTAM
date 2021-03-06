<?php
// src/Ccta/MessageBundle/Entity/Thread.php

namespace Ccta\MessageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\MessageBundle\Entity\Thread as BaseThread;

/**
 * @ORM\Table(name="ccta_message_thread")
 * @ORM\Entity
 */
class Thread extends BaseThread
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Ccta\UserBundle\Entity\User")
	 * @var \FOS\MessageBundle\Model\ParticipantInterface
	 */
	protected $createdBy;

	/**
	 * @ORM\OneToMany(
	 *   targetEntity="Ccta\MessageBundle\Entity\Message",
	 *   mappedBy="thread"
	 * )
	 * @var Message[]|\Doctrine\Common\Collections\Collection
	 */
	protected $messages;

	/**
	 * @ORM\OneToMany(
	 *   targetEntity="Ccta\MessageBundle\Entity\ThreadMetadata",
	 *   mappedBy="thread",
	 *   cascade={"all"}
	 * )
	 * @var ThreadMetadata[]|\Doctrine\Common\Collections\Collection
	 */
	protected $metadata;
}