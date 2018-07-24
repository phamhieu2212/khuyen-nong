<?php namespace App\Http\Requests\Admin;

use App\Http\Requests\BaseRequest;
use App\Repositories\ActionRepositoryInterface;

class ActionRequest extends BaseRequest
{

    /** @var \App\Repositories\ActionRepositoryInterface */
    protected $actionRepository;

    public function __construct(ActionRepositoryInterface $actionRepository)
    {
        $this->actionRepository = $actionRepository;
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
        return $this->actionRepository->rules();
    }

    public function messages()
    {
        return $this->actionRepository->messages();
    }

}
