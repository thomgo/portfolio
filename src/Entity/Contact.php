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
   * @Assert\Regex(
   *     pattern="/\bsexe|\bsex|\bhot girl(s)?|\bfuck|\bdick|\blonely girl(s)?|\bfille(s)? célibataire(s)?|\bmerde|\bbite|\bconnard|\bpute|\bcaca|\beasy cash|\bargent facil(ement)?|\bargent rapid(ement)?|\bdevenir riche|\bmillionaire|\beasy money|\bbitcoin(s)?|\bcryptocurrency|\bcasino(s)?|\bdating site/i",
   *     match=false,
   *     message="Le contenu de votre message semble étrange"
   * )
  */
  private $name;

  /**
   * @var string
   * @Assert\NotBlank
   * @Assert\Email(
   *     message = "Votre email '{{ value }}' n'est pas valide"
   * )
   * @Assert\Regex(
   *     pattern="/\bsexe|\bsex|\bhot girl(s)?|\bfuck|\bdick|\blonely girl(s)?|\bfille(s)? célibataire(s)?|\bmerde|\bbite|\bconnard|\bpute|\bcaca|\beasy cash|\bargent facil(ement)?|\bargent rapid(ement)?|\bdevenir riche|\bmillionaire|\beasy money|\bbitcoin(s)?|\bcryptocurrency|\bcasino(s)?|\bdating site/i",
   *     match=false,
   *     message="Le contenu de votre message semble étrange"
   * )
  */
  private $email;

  /**
   * @var string
   * @Assert\NotBlank
   * @Assert\Length(
   *      min = 50,
   *      minMessage = "Votre message doit contenir au moins {{ limit }} lettres",
   * )
   * @Assert\Regex(
   *     pattern="/\bsexe|\bsex|\bhot girl(s)?|\bfuck|\bdick|\blonely girl(s)?|\bfille(s)? célibataire(s)?|\bmerde|\bbite|\bconnard|\bpute|\bcaca|\beasy cash|\bargent facil(ement)?|\bargent rapid(ement)?|\bdevenir riche|\bmillionaire|\beasy money|\bbitcoin(s)?|\bcryptocurrency|\bcasino(s)?|\bdating site/i",
   *     match=false,
   *     message="Le contenu de votre message semble étrange"
   * )
  */
  private $message;


  /**
   * Get the value of Name
   *
   * @return string
   */
  public function getName(): ?string
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
  public function setName(string $name): Contact
  {
      $this->name = $name;

      return $this;
  }

  /**
   * Get the value of Email
   *
   * @return string
   */
  public function getEmail(): ?string
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
  public function setEmail(string $email): Contact
  {
      $this->email = $email;

      return $this;
  }

  /**
   * Get the value of Message
   *
   * @return string
   */
  public function getMessage(): ?string
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
  public function setMessage(string $message): Contact
  {
      $this->message = $message;

      return $this;
  }

}
