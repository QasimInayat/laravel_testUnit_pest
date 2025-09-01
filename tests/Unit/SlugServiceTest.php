<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\SlugService;

class SlugServiceTest extends TestCase
{
    public function test_generates_slug_correctly()
    {
        $service = new SlugService();
        $slug = $service->generate("Hello World");

        $this->assertEquals("hello-world", $slug);
    }

    public function test_removes_special_characters()
    {
        $service = new SlugService();
        $slug = $service->generate("Laravel @ 2025!");
        $this->assertEquals("laravel-2025", $slug);
    }
}
