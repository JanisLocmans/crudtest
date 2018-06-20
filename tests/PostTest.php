<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Libraries\CRUDPostClass;
use App\User;
use App\Post;
use \Mockery;

class PostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_created_post_found()
    {

        $post = Mockery::mock(Post::class);
        $user = Mockery::mock(User::class);

        $postCrud = new CRUDPostClass($post, $user);

        $user->shouldReceive('find')->andReturn($user);
        $post->shouldReceive('newInstance')->once()->andReturn($post);
        $post->shouldReceive('setAttribute')->with('user_id', '1')->once()->andReturn($post);
        $post->shouldReceive('setAttribute')->with('title', 'title1')->once()->andReturn($post);
        $post->shouldReceive('setAttribute')->with('content', 'content1')->once()->andReturn($post);
        $post->shouldReceive('save')->once()->andReturn($post);

        $data = array(
            'user_id' => '1',
            'title' => 'title1',
            'content' => 'content1'
        );

        $result = $postCrud->create($data);
        
        $this->assertTrue((boolean)$result);
    }

    public function test_created_post_failed()
    {

        $post = Mockery::mock(Post::class);
        $user = Mockery::mock(User::class);

        $postCrud = new CRUDPostClass($post, $user);

        $user->shouldReceive('find')->andReturn(false);


        $data = array(
            'user_id' => '1',
            'title' => 'title1',
            'content' => 'content1'
        );

        $result = $postCrud->create($data);

        //dd(var_dump($result));
        
        $this->assertEquals($result, 'User not Found');
    }

    public function test_get_post()
    {
        $post = Mockery::mock(Post::class);
        $user = Mockery::mock(User::class);
        $postCrud = new CRUDPostClass($post, $user);

        $post->shouldReceive('get')->andReturn($post);

        $result = $postCrud->read();
        $this->assertTrue((boolean)$result);

    }
    public function test_find_post()
    {
        $post = Mockery::mock(Post::class);
        $user = Mockery::mock(User::class);
        $postCrud = new CRUDPostClass($post, $user);

        $post->shouldReceive('find')->andReturn($post);

        $result = $postCrud->read(2);
        $this->assertTrue((boolean)$result);

    }

    public function test_delete_user()
    {
        $post = Mockery::mock(Post::class);
        $user = Mockery::mock(User::class);
        $postCrud = new CRUDPostClass($post, $user);

        $post->shouldReceive('findOrFail')->andReturn($post);
        $post->shouldReceive('delete')->once()->andReturn(true);

        $result = $postCrud->destroy(1);
        $this->assertTrue($result);

    }

    public function test_update_changed()
    {

        $post = Mockery::mock(Post::class);
        $user = Mockery::mock(User::class);
        $postCrud = new CRUDPostClass($post, $user);

        $user->shouldReceive('find')->andReturn($user);
        $post->shouldReceive('findOrFail')->andReturn($post);
        $post->shouldReceive('setAttribute')->with('user_id', '1')->once()->andReturn($post);
        $post->shouldReceive('setAttribute')->with('title', 'title1')->once()->andReturn($post);
        $post->shouldReceive('setAttribute')->with('content', 'content1')->once()->andReturn($post);
        $post->shouldReceive('isDirty')->once()->andReturn(true);
        $post->shouldReceive('save')->once()->andReturn($post);

        $data = array(
            'user_id' => '1',
            'title' => 'title1',
            'content' => 'content1'
        );

        $result = $postCrud->update(2, $data);
        $this->assertTrue((boolean)$result);
    }
    public function test_update_unchanged()
    {

        $post = Mockery::mock(Post::class);
        $user = Mockery::mock(User::class);
        $postCrud = new CRUDPostClass($post, $user);

        $user->shouldReceive('find')->andReturn($user);
        $post->shouldReceive('findOrFail')->andReturn($post);
        $post->shouldReceive('setAttribute')->with('user_id', '1')->once()->andReturn($post);
        $post->shouldReceive('setAttribute')->with('title', 'title1')->once()->andReturn($post);
        $post->shouldReceive('setAttribute')->with('content', 'content1')->once()->andReturn($post);
        $post->shouldReceive('isDirty')->once()->andReturn(false);

        $data = array(
            'user_id' => '1',
            'title' => 'title1',
            'content' => 'content1'
        );

        $result = $postCrud->update(2, $data);
        $this->assertTrue((boolean)$result);
    }
    public function test_update_not_found()
    {

        $post = Mockery::mock(Post::class);
        $user = Mockery::mock(User::class);
        $postCrud = new CRUDPostClass($post, $user);

        $user->shouldReceive('find')->andReturn(false);

        $data = array(
            'user_id' => '1',
            'title' => 'title1',
            'content' => 'content1'
        );

        $result = $postCrud->update(2, $data);
        
        $this->assertEquals($result, 'User not Found');
    }
}
