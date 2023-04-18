<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use PHPUnit\Framework\ExpectationFailedException;

uses(
    Tests\TestCase::class,
)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

expect()->extend('toBePhoneNumber', function () {
    $phoneNumber = Str::of($this->value)->after('+')->__toString();

    if (strlen($phoneNumber) < 6) {
        throw new ExpectationFailedException('Phone number must be 6 characters.');
    }

    if (! is_numeric($phoneNumber)) {
        throw new ExpectationFailedException('Phone number must be numeric.');
    }

    return true;
});

expect()->intercept('toBe', Model::class, function ($value) {

    expect($this->value->is($value))->toBeTrue(message: "Failed asserting that {$this->value} is equal to {$value}.");
});

expect()->intercept('toContain', TestResponse::class, function (...$value) {

    $this->value->assertInertia(fn (AssertableInertia $assert) => $assert->has(...$value));
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}

function login($user = null)
{
    return test()->actingAs($user ?? User::factory()->create(['account_id' => Account::create(['name' => 'Acme Corporation'])->id]));
}
