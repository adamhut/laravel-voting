<?php

namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_generate_default_gravatar_default_image_when_no_mail_found_first_character_a()
    {
        $user = User::factory()->create([
            'name' => 'Adam',
            'email'=>'asfdjfdsfj@fakeemail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/'.md5($user->email).'?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-1.png',
            $gravatarUrl
        );     

    }


    /** @test */
    public function user_can_generate_default_gravatar_default_image_when_no_mail_found_first_character_z()
    {
        $user = User::factory()->create([
            'name' => 'Adam',
            'email' => 'zsfdjfdsfj@fakeemail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/' . md5($user->email) . '?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-26.png',
            $gravatarUrl
        );


    }

    /** @test */
    public function user_can_generate_default_gravatar_default_image_when_no_mail_found_first_character_0()
    {
        $user = User::factory()->create([
            'name' => 'Adam',
            'email' => '0sfdjfdsfj@fakeemail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/' . md5($user->email) . '?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-27.png',
            $gravatarUrl
        );

    }

    /** @test */
    public function user_can_generate_default_gravatar_default_image_when_no_mail_found_first_character_9()
    {
        $user = User::factory()->create([
            'name' => 'Adam',
            'email' => '9sfdjfdsfj@fakeemail.com'
        ]);

        $gravatarUrl = $user->getAvatar();

        $this->assertEquals(
            'https://www.gravatar.com/avatar/' . md5($user->email) . '?s=200&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-36.png',
            $gravatarUrl
        );

    }


}
