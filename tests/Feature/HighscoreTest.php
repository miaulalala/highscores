<?php

namespace Tests\Feature;

use App\Highscore;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HighscoreTest extends TestCase
{
    public function testsHighscoresAreCreatedCorrectly()
    {
        $payload = [
            'fname' => 'Anna',
            'lname' => 'Larch',
            'd_id'  => '1',
            'score' => '1234'
        ];
        $this->json('POST', '/api/highscores', $payload)
            ->assertStatus(201)
            ->assertJson(['data'=>['fname' => 'Anna', 'lname' => 'Larch','score' => '1234']]);
    }
    
    public function testsHighscoressAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        
        $highscore = factory(Highscore::class)->create([
            'fname' => 'Anna',
            'lname' => 'Larch',
            'd_id'  => '1',
            'score' => '1234'
        ]);
        $payload = [
            'id' =>  $highscore->id,
            'approved' => '1',
        ];
        $response = $this->json('PUT', '/api/highscores/' . $highscore->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 
            'id' => $highscore->id,
            'fname' => 'Anna',
            'lname' => 'Larch',
            'score' => '1234',
            'approved' => '1' ]);
    }
    
    public function testsHighscoresAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $highscore = factory(Highscore::class)->create([
            'fname' => 'Anna',
            'lname' => 'Larch',
            'd_id'  => '1',
            'score' => '1234'
        ]);
        $this->json('DELETE', '/api/highscores/' . $highscore->id, [], $headers)
            ->assertStatus(204);
    }
    
    public function testUserCanAccessHighscores()
    {
        factory(Highscore::class)->create();
        $this->json('GET', '/api/highscores')->assertStatus(200);
    }
    
    public function testUserCantAccessNotApproved()
    {
        factory(Highscore::class)->create();
        $this->json('GET', '/api/highscores/notApproved')->assertStatus(401);
    }
    
    public function testAdminCanAccessNotApproved()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        factory(Highscore::class)->create();
        $this->json('GET', '/api/highscores/notApproved',[], $headers)->assertStatus(200);
    }

}
