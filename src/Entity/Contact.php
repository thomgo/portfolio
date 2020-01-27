<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Contact
{

  /**
   * @var string
   * @Assert\NotBlank
   * @Assert\Length(
   *      min = 2,
   *      max = 100,
   *      minMessage = "Votre nom doit contenir au moins {{ limit }} lettres",
   *      maxMessage = "Votre nom ne doit pas contenir plus de {{ limit }} lettres"
   * )
  */
  private $name;

  /**
   * @var string
   * @Assert\NotBlank
   * @Assert\Email(
   *     message = "Votre email '{{ value }}' n'est pas valide"
   * )
  */
  private $email;

  /**
   * @var string
   * @Assert\NotBlank
   * @Assert\Length(
   *      min = 20,
   *      minMessage = "Votre message doit contenir au moins {{ limit }} lettres",
   * )
  */
  private $message;


  /**
   * Get the value of Name
   *
   * @return string
   */
  public function getName()
  {
      return $this->name;
  }

  /**
   * Set the value of Name
   *
   * @param string $name
   *
   * @return self
   */
  public function setName($name)
  {
      $this->name = $name;

      return $this;
  }

  /**
   * Get the value of Email
   *
   * @return string
   */
  public function getEmail()
  {
      return $this->email;
  }

  /**
   * Set the value of Email
   *
   * @param string $email
   *
   * @return self
   */
  public function setEmail($email)
  {
      $this->email = $email;

      return $this;
  }

  /**
   * Get the value of Message
   *
   * @return string
   */
  public function getMessage()
  {
      return $this->message;
  }

  /**
   * Set the value of Message
   *
   * @param string $message
   *
   * @return self
   */
  public function setMessage($message)
  {
      $this->message = $message;

      return $this;
  }

}
