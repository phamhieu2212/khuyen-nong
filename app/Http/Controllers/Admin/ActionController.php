<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\ActionRepositoryInterface;
use App\Http\Requests\Admin\ActionRequest;
use App\Http\Requests\PaginationRequest;

class ActionController extends Controller
{
    /** @var  \App\Repositories\ActionRepositoryInterface */
    protected $actionRepository;

    public function __construct(
        ActionRepositoryInterface $actionRepository
    ) {
        $this->actionRepository = $actionRepository;
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
        $paginate['baseUrl']    = action('Admin\ActionController@index');

        $filter = [];
        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $filter['query'] = $keyword;
        }

        $count = $this->actionRepository->countByFilter($filter);
        $actions = $this->actionRepository->getByFilter($filter, $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit']);

        return view(
            'pages.admin.' . config('view.admin') . '.actions.index',
            [
                'actions'    => $actions,
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
            'pages.admin.' . config('view.admin') . '.actions.edit',
            [
                'isNew'     => true,
                'actions' => $this->actionRepository->getBlankModel(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    $request
     * @return  \Response
     */
    public function store(ActionRequest $request)
    {
        $input = $request->only(
            [
                            'name',
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $action = $this->actionRepository->create($input);

        if( empty($action) ) {
            return redirect()->back()->with('message-error', trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\ActionController@index')
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
        $action = $this->actionRepository->find($id);
        if( empty($action) ) {
            abort(404);
        }

        return view(
            'pages.admin.' . config('view.admin') . '.actions.edit',
            [
                'isNew' => false,
                'action' => $action,
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
    public function update($id, ActionRequest $request)
    {
        /** @var  \App\Models\Action $action */
        $action = $this->actionRepository->find($id);
        if( empty($action) ) {
            abort(404);
        }

        $input = $request->only(
            [
                            'name',
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->actionRepository->update($action, $input);

        return redirect()->action('Admin\ActionController@show', [$id])
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
        /** @var  \App\Models\Action $action */
        $action = $this->actionRepository->find($id);
        if( empty($action) ) {
            abort(404);
        }
        $this->actionRepository->delete($action);

        return redirect()->action('Admin\ActionController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
