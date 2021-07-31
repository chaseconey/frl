<?php

namespace Tests\Unit\Middleware;

use App\Http\Middleware\EnsureDiscordAuthed;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Request;
use Tests\TestCase;

class EnsureDiscordAuthedTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function discord_not_linked_redirected()
    {
        $user = User::factory()->create(['discord_user_id' => null]);

        $this->actingAs($user);

        $request = Request::create('/signup/create');

        $middleware = new EnsureDiscordAuthed();

        $response = $middleware->handle($request, function () {
        });

        $this->assertEquals($response->getStatusCode(), 302);
    }

    /** @test */
    public function discord_linked_not_redirected()
    {
        $user = User::factory()->create(['discord_user_id' => '1234']);

        $this->actingAs($user);

        $request = Request::create('/signup/create');

        $middleware = new EnsureDiscordAuthed();

        $response = $middleware->handle($request, function () {
        });

        $this->assertEquals($response, null);
    }
}
