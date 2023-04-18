<?php

it('does not use debugging functions', function () {

    expect([
        'dump',
        'dd',
        'var_dump',
        'print_r',
    ])->not()->toBeUsed();
});


it('uses the correct redirect function', function () {

    expect(['back','redirect', 'route', 'action'])
        ->not->toBeUsedIn('App\\Http\\Controllers\\');
});

/*it('cannot used facades')
    ->expect->facade('Illuminate\\Support\\Facades\\')
    ->not->toBeUsed();*/
