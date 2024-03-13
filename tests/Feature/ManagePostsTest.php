<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManagePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_a_post()
    {
        // user buka halaman buat post baru
        $this->visit('/post/create');

        // user isi `title`, publish status dan content,
        // lalu klik tombol save
        $this->submitForm('Save', [
            'title' => 'Belajar laravel 10 at qadrLabs',
            'status' => 1, // publish
            'content' => 'Ini adalah content tutorial belajar laravel 10 di qadrLabs'
        ]);

        // lihat data post di database
        $this->seeInDatabase('posts', [
            'title' => 'Belajar laravel 10 at qadrLabs',
            'status' => 1,
            'content' => 'Ini adalah content tutorial belajar laravel 10 di qadrLabs'
        ]);

        // ter-redirect ke halaman daftar post
        $this->seePageIs('/post');

        // lihat post yang sudah diinput
        $this->see('Belajar laravel 10 at qadrLabs'); // ini titlenya
        $this->see('Publish'); // ini statusnya

    }

    /** @test */
    public function user_can_browse_posts_index_page()
    {
        // generate 2 record baru di table `posts`
        $postOne = Post::create([
            'title' => 'Belajar Laravel 8 at qadrLabs edisi 1',
            'content' => 'ini adalah tutorial belajar laravel 8 edisi 1',
            'status' => 1, // publish
            'slug' => 'belajar-laravel-8-edisi-1'
        ]);

        $postTwo = Post::create([
            'title' => 'Belajar Laravel 8 at qadrLabs edisi 2',
            'content' => 'ini adalah tutorial belajar laravel 8 edisi 2',
            'status' => 1, // publish
            'slug' => 'belajar-laravel-8-edisi-2'
        ]);

        // user membuka halaman daftar post
        $this->visit('/post');

        // user melihat dua title dari data post
        $this->see('Belajar Laravel 8 at qadrLabs edisi 1');
        $this->see('Belajar Laravel 8 at qadrLabs edisi 2');

    }

    /** @test */
    public function user_can_edit_existing_post()
    {
        // generate 1 data post
        $post = Post::create([
            'title' => 'Belajar Laravel 8',
            'content' => 'ini content belajar laravel 8',
            'status' => 1, // publish
            'slug' => 'belajar-laravel-8'
        ]);

        // user buka halaman daftar post
        $this->visit('/post');

        // user click tombol edit post
        $this->visit("post/{$post->id}/edit");

        // lihat url yang dituju sesuai dengan post yang diedit
        $this->seePageIs("post/{$post->id}/edit");

        // tampil form edit post
        $this->seeElement('form', [
            'action' => url('post/' . $post->id)
        ]);

        // user submit data post yang diupdate
        $this->submitForm('Update', [
            'title' => 'belajar laravel 8 [update]'
        ]);

        // check perubahan data di table post
        $this->seeInDatabase('posts', [
            'id' => $post->id,
            'title' => 'belajar laravel 8 [update]'
        ]);

        // lihat halaman web yang ter-redirect
        $this->seePageIs('/post');
    }

    /** @test */
    public function user_can_delete_existing_post()
    {
        // generate 1 post data
        $post = Post::create([
            'title' => 'Belajar Laravel 8',
            'content' => 'ini content belajar laravel 8',
            'status' => 1, // publish
            'slug' => 'belajar-laravel-8'
        ]);

        // post delete request
        $this->post('/post/' . $post->id, [
            '_method' => 'DELETE'
        ]);

        // check data di table post
        $this->dontSeeInDatabase('posts', [
            'id' => $post->id
        ]);
    }
}
