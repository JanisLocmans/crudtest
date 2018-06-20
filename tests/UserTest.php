<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Libraries\CRUDUserClass;
use App\User;

use \Mockery;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_created_user_JSON_response_format()
    {

        $user = Mockery::mock(User::class);

        $userCrud = new CRUDUserClass($user);

        $user->shouldReceive('newInstance')->once()->andReturn($user);
        $user->shouldReceive('setAttribute')->with('name', 'Nam1')->once()->andReturn($user);
        $user->shouldReceive('setAttribute')->with('lastname', 'LastNam2')->once()->andReturn($user);
        $user->shouldReceive('save')->once()->andReturn($user);

        $data = array(
            'name' => 'Nam1',
            'lastname' => 'LastNam2'
        );

        $result = $userCrud->create($data);
        
        $this->assertTrue((boolean)$result);
    }

    public function test_updated_user_JSON_response_format_dirty()
    {

        $user = Mockery::mock(User::class);

        $userCrud = new CRUDUserClass($user);


        $user->shouldReceive('findOrFail')->andReturn($user);
        $user->shouldReceive('setAttribute')->with('name', 'Nam1')->once()->andReturn($user);
        $user->shouldReceive('setAttribute')->with('lastname', 'LastNam2')->once()->andReturn($user);
        $user->shouldReceive('isDirty')->once()->andReturn(true);
        $user->shouldReceive('save')->once()->andReturn($user);

        $data = array(
            'name' => 'Nam1',       
            'lastname' => 'LastNam2'
        );

        $result = $userCrud->update(1, $data);
        $this->assertTrue((boolean)$result);
    }
    public function test_updated_user_JSON_response_format_unchanged()
    {

        $user = Mockery::mock(User::class);
        $userCrud = new CRUDUserClass($user);

        $user->shouldReceive('findOrFail')->andReturn($user);
        $user->shouldReceive('setAttribute')->with('name', 'changed23')->once()->andReturn($user);
        $user->shouldReceive('setAttribute')->with('lastname', 'lastnamechang32ed23')->once()->andReturn($user);
        $user->shouldReceive('isDirty')->once()->andReturn(false);

        $data = array(
            'name' => 'changed23',       
            'lastname' => 'lastnamechang32ed23'
        );

        $result = $userCrud->update(2, $data);
        $this->assertTrue((boolean)$result);
    }
    public function test_delete_user()
    {
        $user = Mockery::mock(User::class);
        $userCrud = new CRUDUserClass($user);

        $user->shouldReceive('findOrFail')->andReturn($user);
        $user->shouldReceive('delete')->once()->andReturn(true);

        $result = $userCrud->destroy(1);
        $this->assertTrue($result);

    }
    public function test_get_many_users()
    {
        $user = Mockery::mock(User::class);
        $userCrud = new CRUDUserClass($user);

        $user->shouldReceive('get')->andReturn($user);

        $result = $userCrud->read();
        $this->assertTrue((boolean)$result);

    }
    public function test_get_single_user()
    {
        $user = Mockery::mock(User::class);
        $userCrud = new CRUDUserClass($user);

        $user->shouldReceive('find')->andReturn($user);

        $result = $userCrud->read(2);
        $this->assertTrue((boolean)$result);

    }
}
