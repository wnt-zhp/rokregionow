<?php

namespace ZHP\RokRegionowBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

#TODO
#find out how to make some fixtures or factories in Symfony

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        //$this->assertTrue($crawler->filter('html:contains("Grzegorz")')->count() > 0);
        $this->assertTrue($client->getResponse()->getStatusCode() == '200' );
    }

    public function testShow()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/druzyna/77gdh');

        //$this->assertTrue($crawler->filter('html:contains("Grzegorz")')->count() > 0);
        $this->assertTrue($client->getResponse()->getStatusCode() == '200' );
    }
}

?>
