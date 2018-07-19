<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\AdminUserRepositoryInterface;
use App\Http\Requests\Admin\AdminUserRequest;
use App\Http\Requests\PaginationRequest;

class AdminUserController extends Controller
{
    /** @var  \App\Repositories\AdminUserRepositoryInterface */
    protected $adminUserRepository;

    public function __construct(
        AdminUserRepositoryInterface $adminUserRepository
    ) {
        $this->adminUserRepository = $adminUserRepository;
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
                'isNew'     => true,
                'adminUsers' => $this->adminUserRepository->getBlankModel(),
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
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $adminUser = $this->adminUserRepository->create($input);

        if( empty($adminUser) ) {
            return redirect()->back()->with('message-error', trans('admin.errors.general.save_failed'));
        }

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
