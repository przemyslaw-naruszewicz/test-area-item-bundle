<?php

namespace TestArea\ItemBundle\Test;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;
use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\Client;

/**
 * Class ItemResourceApiTest
 * @package TestArea\ItemBundle\Test
 */
class ItemResourceApiTest extends ApiTestCase
{
    /** Reset db: bin/console insert:item-data --truncate */

    /**
     * @var Client
     */
    private $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = self::createClient();
    }

    public function test_get_collection(): void
    {
        $this->client->request('GET', '/api/test_area/items');
        $this->assertResponseIsSuccessful();
    }

    public function test_get_item(): void
    {
        $this->client = self::createClient();
        $this->client->request('GET', '/api/test_area/items/2');

        $this->assertResponseIsSuccessful();
    }

    public function test_post(): void
    {
        $this->client->request('POST', '/api/test_area/items', [
            'json' => [
                "name" => "Produkt 22",
                "amount" => 32,
            ]
        ]);

        $this->assertResponseStatusCodeSame(201);
    }

    public function test_post_invalid_dataset(): void
    {
        $this->client->request('POST', '/api/test_area/items', [
            'json' => [
                "name" => "Produkt 22",
            ]
        ]);

        $this->assertResponseStatusCodeSame(400);
    }

    public function test_patch(): void
    {
        $this->client->request('PATCH', '/api/test_area/items/2', [
            'json' => [
                "name" => "test test",
            ],
            'headers' => [
                'Content-Type' => 'application/merge-patch+json'
            ]
        ]);

        $this->assertResponseIsSuccessful();
    }

    public function test_delete(): void
    {
        $this->client->request('DELETE', '/api/test_area/items/5');
        $this->assertResponseStatusCodeSame(204);
    }
}
