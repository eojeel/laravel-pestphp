<?php

use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

it('can log in a user', function () {

    $credentials = [
        'account_id' => Account::create(['name' => 'Acme Corporation'])->id,
        'first_name' => 'John',
        'last_name' => 'Doe',
        'email' => 'test@example.com',
        'password' => 'secret',
        'owner' => true,
    ];

    $user = User::factory()->create($credentials);

    $this->post(route('login'), $credentials);

    expect(Auth::user())->toBe($user);
});
