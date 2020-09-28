<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    /**
     * Basic app test.
     *
     * @return void
     */
    public function testBase()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
