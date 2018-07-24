<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class HtxControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\HtxController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\HtxController::class);
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
        $response = $this->action('GET', 'Admin\HtxController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\HtxController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $htx = factory(\App\Models\Htx::class)->make();
        $this->action('POST', 'Admin\HtxController@store', [
                '_token' => csrf_token(),
            ] + $htx->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $htx = factory(\App\Models\Htx::class)->create();
        $this->action('GET', 'Admin\HtxController@show', [$htx->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $htx = factory(\App\Models\Htx::class)->create();

        $name = $faker->name;
        $id = $htx->id;

        $htx->name = $name;

        $this->action('PUT', 'Admin\HtxController@update', [$id], [
                '_token' => csrf_token(),
            ] + $htx->toArray());
        $this->assertResponseStatus(302);

        $newHtx = \App\Models\Htx::find($id);
        $this->assertEquals($name, $newHtx->name);
    }

    public function testDeleteModel()
    {
        $htx = factory(\App\Models\Htx::class)->create();

        $id = $htx->id;

        $this->action('DELETE', 'Admin\HtxController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkHtx = \App\Models\Htx::find($id);
        $this->assertNull($checkHtx);
    }

}
