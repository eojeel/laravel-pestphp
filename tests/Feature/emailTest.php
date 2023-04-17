<?php

use App\Rules\IsValidEmailAddress;
use Illuminate\Support\Facades\Validator;

uses()->group('email');

it('can validate an email', function () {
    $validator = Validator::make(['email' => 'me@me.com'], ['email' => new IsValidEmailAddress()]);

    expect($validator->validated())->toBe(['email' => 'me@me.com']);
})->skip(getenv('SKIP_TESTS') ?? false, 'Skip tests');


it('validation fails for non string', function () {
    $validator = Validator::make(['email' => 123], ['email' => new IsValidEmailAddress()]);

    $validator->validate();

})->throws('The value must be a string!');

it('validation fails for string', function () {
    $validator = Validator::make(['email' => 'testing'], ['email' => new IsValidEmailAddress()]);

    $validator->validate();

})->throws('The value must be a valid email address!');
