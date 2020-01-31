<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
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
  public function testIndexDisplaysTitles($project) {
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
}
