<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\AdminUserRepositoryInterface;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\AdminUserRoleRepositoryInterface;
use App\Repositories\CertificateRepositoryInterface;
use App\Repositories\Eloquent\CertificateRepository;
use App\Repositories\FarmerCertificateRepositoryInterface;
use App\Repositories\FarmerRepositoryInterface;
use App\Repositories\HtxRepositoryInterface;

class AdminUserController extends Controller
{
    /** @var  \App\Repositories\AdminUserRepositoryInterface */
    protected $adminUserRepository;
    protected $htxRepository;
    protected $certificateRepository;
    protected $adminUserRoleRepository;
    protected $farmerCertificateRepository;
    protected $farmerRepository;



    public function __construct(
        AdminUserRepositoryInterface   $adminUserRepository,
        HtxRepositoryInterface         $htxRepository,
        CertificateRepositoryInterface $certificateRepository,
        AdminUserRoleRepositoryInterface $adminUserRoleRepository,
        FarmerCertificateRepositoryInterface $farmerCertificateRepository,
        FarmerRepositoryInterface            $farmerRepository
    ) {
        $this->adminUserRepository   = $adminUserRepository;
        $this->certificateRepository = $certificateRepository;
        $this->htxRepository         = $htxRepository;
        $this->adminUserRoleRepository = $adminUserRoleRepository;
        $this->farmerCertificateRepository = $farmerCertificateRepository;
        $this->farmerRepository            = $farmerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param    \App\Http\Requests\PaginationRequest $request
     * @return  \Response
     */
    public function index(PaginationRequest $request)
    {
        $paginate['limit']      = $request->limit();
        $paginate['offset']     = $request->offset();
        $paginate['order']      = $request->order();
        $paginate['direction']  = $request->direction();
        $paginate['baseUrl']    = action('Admin\AdminUserController@index');

        $filter = [];
        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $filter['query'] = $keyword;
        }

        $count = $this->adminUserRepository->countByFilter($filter);
        $adminUsers = $this->adminUserRepository->getByFilter($filter, $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit']);

        return view(
            'pages.admin.' . config('view.admin') . '.admin-users.index',
            [
                'adminUsers'    => $adminUsers,
                'count'         => $count,
                'paginate'      => $paginate,
                'keyword'       => $keyword
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return  \Response
     */
    public function create()
    {
        return view(
            'pages.admin.' . config('view.admin') . '.admin-users.edit',
            [
                'isNew'        => true,
                'adminUsers'   => $this->adminUserRepository->getBlankModel(),
                'htxes'        => $this->htxRepository->all(),
                'certificates' => $this->certificateRepository->all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    $request
     * @return  \Response
     */
    public function store(AdminUserRequest $request)
    {
        $input = $request->only(
            [
                            'name',
                            'email',
                            'password',
                            'locale',
                            'remember_token',
                            'api_access_token',
                            'profile_image_id',
                            'last_notification_id',
                            'htx_id',
                            'certificate_id'
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $adminUser = $this->adminUserRepository->create($input);

        if( empty($adminUser) ) {
            return redirect()->back()->with('message-error', trans('admin.errors.general.save_failed'));
        }
        $this->farmerRepository->checkFarmer($request->input('htx_id'),$adminUser->id, $request->input('role', []));
        $this->adminUserRoleRepository->setAdminUserRoles($adminUser->id, $request->input('role', []));
        $adminUser->certificates()->sync($request->input('certificate_id'));

        $adminUser->save();


        return redirect()->action('Admin\AdminUserController@index')
            ->with('message-success', trans('admin.messages.general.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param    int $id
     * @return  \Response
     */
    public function show($id)
    {
        $adminUser = $this->adminUserRepository->find($id);
        if( empty($adminUser) ) {
            abort(404);
        }

        return view(
            'pages.admin.' . config('view.admin') . '.admin-users.edit',
            [
                'isNew' => false,
                'adminUser' => $adminUser,
                'htxes'        => $this->htxRepository->all(),
                'certificates' => $this->certificateRepository->all()
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param    int $id
     * @return  \Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param    int $id
     * @param            $request
     * @return  \Response
     */
    public function update($id, AdminUserRequest $request)
    {
        /** @var  \App\Models\AdminUser $adminUser */
        $adminUser = $this->adminUserRepository->find($id);
        if( empty($adminUser) ) {
            abort(404);
        }

        $input = $request->only(
            [
                            'name',
                            'email',
                            'password',
                            'locale',
                            'remember_token',
                            'api_access_token',
                            'profile_image_id',
                            'last_notification_id',
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->adminUserRepository->update($adminUser, $input);
        $this->adminUserRoleRepository->setAdminUserRoles($adminUser->id, $request->input('role', []));

        return redirect()->action('Admin\AdminUserController@show', [$id])
                    ->with('message-success', trans('admin.messages.general.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param    int $id
     * @return  \Response
     */
    public function destroy($id)
    {
        /** @var  \App\Models\AdminUser $adminUser */
        $adminUser = $this->adminUserRepository->find($id);
        if( empty($adminUser) ) {
            abort(404);
        }
        $this->adminUserRepository->delete($adminUser);

        return redirect()->action('Admin\AdminUserController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
