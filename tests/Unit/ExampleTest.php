<?php

use App\Services\SlugService;

test('it generates a slug correctly', function () {
    $service = new SlugService();
    $slug = $service->generate('Hello World');

    expect($slug)->toBe('hello-world');
});

