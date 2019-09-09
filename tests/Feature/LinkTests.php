<?php

namespace Tests\Feature;

use App\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkTests extends TestCase
{
    use RefreshDatabase;

    public function testCreateShortLinkPage()
    {
        $response = $this->get(route('create-short-link'));

        $response->assertStatus(200);
    }

    public function testNewValidUrlForShorten()
    {
        $url = 'https://www.google.com/';
        $this->post(route('handle-new-link'), ['original_link' => $url]);

        $this->assertDatabaseHas('links', ['original_link' => $url]);
    }

    public function testNewInvalidUrlForShorten()
    {
        $linkCountBefore = Link::count();

        $this->post(route('handle-new-link'), ['original_link' => 'www.googledfssdfsdfsdfsf.com']);

        $this->assertEquals($linkCountBefore, Link::count());
    }

    public function testAlreadyExistingUrl()
    {
        $linkCountBefore = Link::count();

        $this->post(route('handle-new-link'), ['original_link' => 'www.google.com']);
        $this->post(route('handle-new-link'), ['original_link' => 'www.google.com']);

        $this->assertEquals($linkCountBefore, Link::count());
    }

    public function testRedirectByShortLink()
    {
        $url = 'https://www.google.com/';
        $this->post(route('create-short-link'), ['original_link' => $url]);
        $link = Link::where('original_link', $url)->first();
        $response = $this->get(route('short-link', $link->id));
        $response->assertRedirect($url);
    }

    public function testShowInfoPage()
    {
        $url = 'https://www.google.com/';
        $this->post(route('create-short-link', ['original_link' => $url]));
        $link = Link::where('original_link', $url)->first();

        $response = $this->get(route('link-information', ['short_link' => $link->short_link]));
        $response->assertStatus(200);
    }

    public function testNotFoundLink()
    {
        $response = $this->get(route('link-information', 'sdffdfsd12e123sddfsdfdfsd4'));
        $response->assertStatus(404);
    }

    public function testFlashMessageAfterCreation()
    {
        $response = $this->post(route('handle-new-link'), ['original_link' => 'https://laravel.com/']);

        $response->assertSessionHas('message', 'Successfully create');
    }
}
