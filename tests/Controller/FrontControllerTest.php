<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Filesystem\Filesystem;
use App\Repository\ProjectRepository;
use App\Entity\Project;

class FrontControllerTest extends WebTestCase
{
  /**
  * @dataProvider provideUrls
  */
  public function testPageIsSuccessful($url)
  {
    $client = self::createClient();
    $client->request('GET', $url);

    $this->assertTrue($client->getResponse()->isSuccessful());
  }

  /**
  * @dataProvider provideUrls
  */
  public function testPageContainsTitles($url)
  {
    $client = self::createClient();
    $crawler = $client->request('GET', $url);

    $this->assertCount(1, $crawler->filter('h1'));
    $this->assertCount(1, $crawler->filter('h2'));
    $this->assertCount(1, $crawler->filter('h3'));
  }

  public function provideUrls()
  {
    return [
        ['/'],
        ['/apropos'],
        ['/contact'],
    ];
  }

  public function testIndexDisplaysProjects() {
    $projects = $this->provideProjects();
    $client = self::createClient();
    $crawler = $client->request('GET', '/');

    $this->assertCount(count($projects), $crawler->filter('article.card'));
    $this->assertCount(count($projects), $crawler->filter('article.card button'));
    $this->assertCount(count($projects), $crawler->filter('section.modal'));
  }

  /**
  * @dataProvider provideProjects
  */
  public function testIndexHtmlStructure($project) {
    $client = self::createClient();
    $crawler = $client->request('GET', '/');
    $this->assertSelectorTextContains("article.card button:contains($project)", $project);
  }

  public function provideProjects() {
    return [
      ["Ex Libris"],
      ["ADEP anglais"],
      ["Carnet de notes"],
      ["SocNet98"],
      ["Fiches méthodologiques"],
      ["Jeu des paires"],
      ["Coach sportif"],
      ["Cercle suédois"]
    ];
  }

  public function testAboutHtmlStructure() {
    $client = self::createClient();
    $crawler = $client->request('GET', '/apropos');
    $this->assertCount(3, $crawler->filter('h4'));
    $this->assertCount(1, $crawler->filter('img#bio-image'));
    $this->assertCount(2, $crawler->filter('ul.skills-list'));
  }

  public function testAboutImages() {
    $client = self::createClient();
    $filesystem = new Filesystem();
    $crawler = $client->request('GET', '/apropos');

    $bioImageSrc = $crawler->filter('img#bio-image')->attr('src');
    $this->assertTrue($filesystem->exists("public/" . $bioImageSrc));

    $listImages = $crawler->filter('ul.skills-list li a img');
    foreach ($listImages as $key => $image) {
      $src = $image->getAttribute('src');
      $this->assertTrue($filesystem->exists("public/" . $src));
    }
  }

  public function testContactHtmlStructure() {
    $client = self::createClient();
    $crawler = $client->request('GET', '/contact');
    $this->assertCount(1, $crawler->filter('form'));
    $this->assertCount(1, $crawler->filter('form input[type=text]'));
    $this->assertCount(1, $crawler->filter('form input[type=email]'));
    $this->assertCount(1, $crawler->filter('form textarea'));
    $this->assertCount(1, $crawler->filter('form button[type=submit]'));
  }

  /**
  * @dataProvider provideContacts
  */
  public function testContactFormValidation($name, $email, $message, $errors, $success) {
    $client = static::createClient();
    $crawler = $client->request('GET', '/contact');

    $form = $crawler->selectButton('Envoyer')->form([
      "contact[name]" => $name,
      "contact[email]" => $email,
      "contact[message]" => $message
    ]);

    $crawler = $client->submit($form);
    $this->assertTrue($client->getResponse()->isSuccessful());
    $this->assertEquals($errors, $crawler->filter('span.form-error-message')->count());
    $this->assertEquals($success, $crawler->filter('div.alert-success')->count());
  }

  public function provideContacts() {
    return [
      [
        't',
        't',
        'b',
        3,
        0
      ],
      [
        't',
        'test@gmail.com',
        'b',
        2,
        0
      ],
      [
        'Joe',
        'testgmail.com',
        'test',
        2,
        0
      ],
      [
        'Joe',
        'test@gmail.com',
        'argent facile',
        2,
        0
      ],
      [
        'Joe',
        'test@gmail.com',
        'Bonjour, nous avons une offre à vous faire qui pourrait intéresser, voulez-vous rencontrer des filles célibataire ?',
        1,
        0
      ],
      [
        'Joe',
        'jhondoe@yahoo.com',
        'Bonjour, nous avons une offre à vous faire qui pourrait intéresser, voulez-vous en discuter ?',
        0,
        1
      ],
      [
        'JackJack',
        'jackruban@devcompagny.com',
        'Hi we have got an easy job for you that could help you making a lot of money',
        0,
        1
      ],
    ];
  }

}
