<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RememberMeCookieTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_with_remember_me_sets_recaller_cookie(): void
    {
        $user = User::factory()->create([
            'email' => 'remember@example.com',
            'password' => 'password',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
            'remember' => '1',
        ]);

        $response->assertRedirect('/dashboard');
        $response->assertCookie(Auth::getRecallerName());
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_without_remember_me_does_not_set_recaller_cookie(): void
    {
        $user = User::factory()->create([
            'email' => 'noremember@example.com',
            'password' => 'password',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/dashboard');
        $response->assertCookieMissing(Auth::getRecallerName());
        $this->assertAuthenticatedAs($user);
    }
}
