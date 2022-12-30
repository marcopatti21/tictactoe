<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;

use Tests\TestCase;

class GameTest extends TestCase
{
    use DatabaseMigrations;

    public function testPlayer1ShouldWin()
    {
        $response = $this->post('/api/game/create');
        $response->assertCreated();

        $gameId = $response->decodeResponseJson()['id'];

        $response = $this->put(
            '/api/game/move', 
            [
                'gameId' => $gameId,
                'playerId' => 1,
                'position' => 0
            ]);

        $this->put(
            '/api/game/move', 
            [
                'gameId' => $gameId,
                'playerId' => 2,
                'position' => 3
            ]);

        $this->put(
            '/api/game/move', 
            [
                'gameId' => $gameId,
                'playerId' => 1,
                'position' => 1
            ]);

        $this->put(
            '/api/game/move', 
            [
                'gameId' => $gameId,
                'playerId' => 2,
                'position' => 4
            ]);

        $response = $this->put(
            '/api/game/move', 
            [
                'gameId' => $gameId,
                'playerId' => 1,
                'position' => 2
            ]);

        $body = $response->decodeResponseJson();

        $this->assertTrue($body['winner']);
        $this->assertEquals(1, $body['winnerId']);
    }
}
