<?php namespace App\Repositories\Eloquent;

use \App\Repositories\ActionRepositoryInterface;
use \App\Models\Action;

class ActionRepository extends SingleKeyModelRepository implements ActionRepositoryInterface
{

    public function getBlankModel()
    {
        return new Action();
    }

    public function rules()
    {
        return [
        ];
    }

    public function messages()
    {
        return [
        ];
    }

}
