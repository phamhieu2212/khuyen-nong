<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\HtxRepositoryInterface;
use App\Http\Requests\Admin\HtxRequest;
use App\Http\Requests\PaginationRequest;

class HtxController extends Controller
{
    /** @var  \App\Repositories\HtxRepositoryInterface */
    protected $htxRepository;

    public function __construct(
        HtxRepositoryInterface $htxRepository
    ) {
        $this->htxRepository = $htxRepository;
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
        $paginate['baseUrl']    = action('Admin\HtxController@index');

        $filter = [];
        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $filter['query'] = $keyword;
        }

        $count = $this->htxRepository->countByFilter($filter);
        $htxes = $this->htxRepository->getByFilter($filter, $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit']);

        return view(
            'pages.admin.' . config('view.admin') . '.htxes.index',
            [
                'htxes'    => $htxes,
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
            'pages.admin.' . config('view.admin') . '.htxes.edit',
            [
                'isNew'     => true,
                'htxes' => $this->htxRepository->getBlankModel(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    $request
     * @return  \Response
     */
    public function store(HtxRequest $request)
    {
        $input = $request->only(
            [
                            'name',
                            'address',
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $htx = $this->htxRepository->create($input);

        if( empty($htx) ) {
            return redirect()->back()->with('message-error', trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\HtxController@index')
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
        $htx = $this->htxRepository->find($id);
        if( empty($htx) ) {
            abort(404);
        }

        return view(
            'pages.admin.' . config('view.admin') . '.htxes.edit',
            [
                'isNew' => false,
                'htx' => $htx,
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
    public function update($id, HtxRequest $request)
    {
        /** @var  \App\Models\Htx $htx */
        $htx = $this->htxRepository->find($id);
        if( empty($htx) ) {
            abort(404);
        }

        $input = $request->only(
            [
                            'name',
                            'address',
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->htxRepository->update($htx, $input);

        return redirect()->action('Admin\HtxController@show', [$id])
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
        /** @var  \App\Models\Htx $htx */
        $htx = $this->htxRepository->find($id);
        if( empty($htx) ) {
            abort(404);
        }
        $this->htxRepository->delete($htx);

        return redirect()->action('Admin\HtxController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
