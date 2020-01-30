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

  public function provideUrls()
  {
    return [
        ['/'],
        ['/apropos'],
        ['/contact'],
    ];
  }
}
