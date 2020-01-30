<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

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
}
