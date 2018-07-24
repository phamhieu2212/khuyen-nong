<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class ActionControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\ActionController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\ActionController::class);
        $this->assertNotNull($controller);
    }

    public function setUp()
    {
        parent::setUp();
        $authUser = \App\Models\AdminUser::first();
        $this->be($authUser, 'admins');
    }

    public function testGetList()
    {
        $response = $this->action('GET', 'Admin\ActionController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\ActionController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $action = factory(\App\Models\Action::class)->make();
        $this->action('POST', 'Admin\ActionController@store', [
                '_token' => csrf_token(),
            ] + $action->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $action = factory(\App\Models\Action::class)->create();
        $this->action('GET', 'Admin\ActionController@show', [$action->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $action = factory(\App\Models\Action::class)->create();

        $name = $faker->name;
        $id = $action->id;

        $action->name = $name;

        $this->action('PUT', 'Admin\ActionController@update', [$id], [
                '_token' => csrf_token(),
            ] + $action->toArray());
        $this->assertResponseStatus(302);

        $newAction = \App\Models\Action::find($id);
        $this->assertEquals($name, $newAction->name);
    }

    public function testDeleteModel()
    {
        $action = factory(\App\Models\Action::class)->create();

        $id = $action->id;

        $this->action('DELETE', 'Admin\ActionController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkAction = \App\Models\Action::find($id);
        $this->assertNull($checkAction);
    }

}
