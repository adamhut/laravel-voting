<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GravatarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_generate_default_gravatar_default_image_when_no_mail_found_first_character_a()
    {
        $user = User::factory()->create([
            'name' => 'Adam',
            'email' => 'asfdjfdsfj@fakeemail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/' . md5($user->email) . '?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-1.png',
            $gravatarUrl
        );

        $response = Http::get($user->getAvatar());

        $this->assertTrue($response->successful());
    }


}
