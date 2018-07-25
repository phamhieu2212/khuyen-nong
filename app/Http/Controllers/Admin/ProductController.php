<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Repositories\ActionRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ProductActionRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Requests\PaginationRequest;
use App\Repositories\ProductUnitRepositoryInterface;
use App\Repositories\UnitRepositoryInterface;

class ProductController extends Controller
{
    /** @var  \App\Repositories\ProductRepositoryInterface */
    protected $productRepository;
    protected $categoryRepository;
    protected $unitRepository;
    protected $actionRepository;
    protected $productUnitRepository;
    protected $productActionRepository;

    public function __construct(
        ProductRepositoryInterface          $productRepository,
        CategoryRepositoryInterface         $categoryRepository,
        UnitRepositoryInterface             $unitRepository,
        ActionRepositoryInterface           $actionRepository,
        ProductUnitRepositoryInterface      $productUnitRepository,
        ProductActionRepositoryInterface    $productActionRepository
    ) {
        $this->productRepository       = $productRepository;
        $this->categoryRepository      = $categoryRepository;
        $this->unitRepository          = $unitRepository;
        $this->actionRepository        = $actionRepository;
        $this->productUnitRepository   = $productUnitRepository;
        $this->productActionRepository = $productActionRepository;
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
        $paginate['baseUrl']    = action('Admin\ProductController@index');

        $filter = [];
        $keyword = $request->get('keyword');
        if (!empty($keyword)) {
            $filter['query'] = $keyword;
        }

        $count = $this->productRepository->countByFilter($filter);
        $products = $this->productRepository->getByFilter($filter, $paginate['order'], $paginate['direction'], $paginate['offset'], $paginate['limit']);

        return view(
            'pages.admin.' . config('view.admin') . '.products.index',
            [
                'products'    => $products,
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
            'pages.admin.' . config('view.admin') . '.products.edit',
            [
                'isNew'     => true,
                'products'  => $this->productRepository->getBlankModel(),
                'categories'=> $this->categoryRepository->all(),
                'actions'   => $this->actionRepository->all(),
                'units'     => $this->unitRepository->all()


            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param    $request
     * @return  \Response
     */
    public function store(ProductRequest $request)
    {
        $input = $request->only(
            [
                            'name',
                            'category_id',
                            'cover_image_id',
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $product = $this->productRepository->create($input);

        if( empty($product) ) {
            return redirect()->back()->with('message-error', trans('admin.errors.general.save_failed'));
        }
        $product->actions()->sync($request->input('action_id'));
        $product->units()->sync($request->input('unit_id'));

        return redirect()->action('Admin\ProductController@index')
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
        $product = $this->productRepository->find($id);
        if( empty($product) ) {
            abort(404);
        }

        return view(

            'pages.admin.' . config('view.admin') . '.products.edit',
            [
                'isNew' => false,
                'product' => $product,
                'categories'=> $this->categoryRepository->all(),
                'actions'   => $this->actionRepository->all(),
                'units'     => $this->unitRepository->all(),
                'productAction' => $product->actions->keyBy('id'),
                'productUnit' => $product->units->keyBy('id')
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
    public function update($id, ProductRequest $request)
    {
        /** @var  \App\Models\Product $product */
        $product = $this->productRepository->find($id);
        if( empty($product) ) {
            abort(404);
        }

        $input = $request->only(
            [
                            'name',
                            'category_id',
                            'cover_image_id',
                        ]
        );

        $input['is_enabled'] = $request->get('is_enabled', 0);
        $this->productRepository->update($product, $input);
        $product->units()->sync($request->input('unit_id',[]));
        $product->actions()->sync($request->input('action_id',[]));

        return redirect()->action('Admin\ProductController@show', [$id])
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
        /** @var  \App\Models\Product $product */
        $product = $this->productRepository->find($id);
        if( empty($product) ) {
            abort(404);
        }
        $this->productRepository->delete($product);

        return redirect()->action('Admin\ProductController@index')
                    ->with('message-success', trans('admin.messages.general.delete_success'));
    }

}
