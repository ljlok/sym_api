<?php
namespace Acme\BhiBundle\Tests\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase as WebTestCase;
use Acme\BhiBundle\Tests\Fixtures\Entity\LoadUserData;

class UserControllerTest extends WebTestCase
{
    public function setUp()
    {
        $this->auth = array(
            'PHP_AUTH_USER' => 'user',
            'PHP_AUTH_PW' => 'userpass'
        );

        $this->client = static::createClient(array(), $this->auth);
    }

    public function testJsonGetUserAction()
    {
        $fixtures = array('Acme\BhiBundle\Tests\Fixtures\Entity\LoadUserData');
        $this->loadFixtures($fixtures);
        $users = LoadUserData::$users;
        $user = array_pop($users);

        $route = $this->getUrl('api_1_get_user', array('id' => $user->getId(), '_format' => 'json'));
        $this->client->request('GET', $route, array('ACCEPT' => 'application/json'));
        $response = $this->client->getResponse();
        return $response;
        $this->assertJsonResponse($response, 200);
        $content = $response->getContent();

        $decoded = json_decode($content, true);
        $this->assertTrue(isset($decoded['id']));
    }

    public function testLoginAction()
    {
        #$crawler = $this->client->request('POST', 'login');

        $form = $crawler->selectButton('submit')->form();
        $form['username'] = 'admin';
        $form['password'] = 'admin';

        $crawler = $this->client->submit(form);


    }


    protected function assertJsonResponse(
        $response,
        $statusCode = 200,
        $checkValidJson =  true,
        $contentType = 'application/json'
    )
    {
        $this->assertEquals(
            $statusCode, $response->getStatusCode(),
            $response->getContent()
        );
        $this->assertTrue(
            $response->headers->contains('Content-Type', $contentType),
            $response->headers
        );
        if ($checkValidJson) {
            $decode = json_decode($response->getContent());
            $this->assertTrue(($decode != null && $decode != false),
                'is response valid json: [' . $response->getContent() . ']'
            );
        }
    }
}


