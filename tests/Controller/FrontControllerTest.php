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
}
