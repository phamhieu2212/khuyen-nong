<?php  namespace Tests\Controllers\Admin;

use Tests\TestCase;

class CertificateControllerTest extends TestCase
{

    protected $useDatabase = true;

    public function testGetInstance()
    {
        /** @var  \App\Http\Controllers\Admin\CertificateController $controller */
        $controller = \App::make(\App\Http\Controllers\Admin\CertificateController::class);
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
        $response = $this->action('GET', 'Admin\CertificateController@index');
        $this->assertResponseOk();
    }

    public function testCreateModel()
    {
        $this->action('GET', 'Admin\CertificateController@create');
        $this->assertResponseOk();
    }

    public function testStoreModel()
    {
        $certificate = factory(\App\Models\Certificate::class)->make();
        $this->action('POST', 'Admin\CertificateController@store', [
                '_token' => csrf_token(),
            ] + $certificate->toArray());
        $this->assertResponseStatus(302);
    }

    public function testEditModel()
    {
        $certificate = factory(\App\Models\Certificate::class)->create();
        $this->action('GET', 'Admin\CertificateController@show', [$certificate->id]);
        $this->assertResponseOk();
    }

    public function testUpdateModel()
    {
        $faker = \Faker\Factory::create();

        $certificate = factory(\App\Models\Certificate::class)->create();

        $name = $faker->name;
        $id = $certificate->id;

        $certificate->name = $name;

        $this->action('PUT', 'Admin\CertificateController@update', [$id], [
                '_token' => csrf_token(),
            ] + $certificate->toArray());
        $this->assertResponseStatus(302);

        $newCertificate = \App\Models\Certificate::find($id);
        $this->assertEquals($name, $newCertificate->name);
    }

    public function testDeleteModel()
    {
        $certificate = factory(\App\Models\Certificate::class)->create();

        $id = $certificate->id;

        $this->action('DELETE', 'Admin\CertificateController@destroy', [$id], [
                '_token' => csrf_token(),
            ]);
        $this->assertResponseStatus(302);

        $checkCertificate = \App\Models\Certificate::find($id);
        $this->assertNull($checkCertificate);
    }

}
