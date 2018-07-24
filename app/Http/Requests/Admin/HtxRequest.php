<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\HtxRepositoryInterface;

class HtxRequest extends BaseRequest
{

    /** @var \App\Repositories\HtxRepositoryInterface */
    protected $htxRepository;

    public function __construct(HtxRepositoryInterface $htxRepository)
    {
        $this->htxRepository = $htxRepository;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->htxRepository->rules();
    }

    public function messages()
    {
        return $this->htxRepository->messages();
    }

}
