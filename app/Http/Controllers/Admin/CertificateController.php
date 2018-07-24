<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\CertificateRepositoryInterface;
use App\Http\Requests\Admin\CertificateRequest;
use App\Http\Requests\PaginationRequest;

class CertificateController extends Controller
{
    /** @var  \App\Repositories\CertificateRepositoryInterface */
    protected $certificateRepository;

    public function __construct(
        CertificateRepositoryInterface $certificateRepository
    ) {
        $this->certificateRepository = $certificateRepository;
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
        $paginate['baseUrl']    = action('Admin\CertificateController@index');

        $filter = [];
        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $filter['query'] = $keyword;
        }

        $count = $this->certificateRepository->countByFilter($filter);
        $certificates = $this->certificateRepository->getByFilter($filter, $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit']);

        return view(
            'pages.admin.' . config('view.admin') . '.certificates.index',
            [
                'certificates'    => $certificates,
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
            'pages.admin.' . config('view.admin') . '.certificates.edit',
            [
                'isNew'     => true,
                'certificates' => $this->certificateRepository->getBlankModel(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    $request
     * @return  \Response
     */
    public function store(CertificateRequest $request)
    {
        $input = $request->only(
            [
                            'name',
                            'type',
                            'description',
                            'logo_image_id',
                            'cover_image_id',
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $certificate = $this->certificateRepository->create($input);

        if( empty($certificate) ) {
            return redirect()->back()->with('message-error', trans('admin.errors.general.save_failed'));
        }

        return redirect()->action('Admin\CertificateController@index')
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
        $certificate = $this->certificateRepository->find($id);
        if( empty($certificate) ) {
            abort(404);
        }

        return view(
            'pages.admin.' . config('view.admin') . '.certificates.edit',
            [
                'isNew' => false,
                'certificate' => $certificate,
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
    public function update($id, CertificateRequest $request)
    {
        /** @var  \App\Models\Certificate $certificate */
        $certificate = $this->certificateRepository->find($id);
        if( empty($certificate) ) {
            abort(404);
        }

        $input = $request->only(
            [
                            'name',
                            'type',
                            'description',
                            'logo_image_id',
                            'cover_image_id',
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->certificateRepository->update($certificate, $input);

        return redirect()->action('Admin\CertificateController@show', [$id])
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
        /** @var  \App\Models\Certificate $certificate */
        $certificate = $this->certificateRepository->find($id);
        if( empty($certificate) ) {
            abort(404);
        }
        $this->certificateRepository->delete($certificate);

        return redirect()->action('Admin\CertificateController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
