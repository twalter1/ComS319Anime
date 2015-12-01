<?php

namespace App\Http\Requests;

class UserEditRequest extends Request
{

    /**
     *
     * The Entrust permission required to preform this request.
     *
     * @var string
     *
     */
    protected $permission = "edit-user";

    /**
     *
     * The actionable description of the request.
     *
     * @var string
     *
     */
    protected $error_msg = "edit user";


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $user = auth()->user();

        if ($user) {
            return $this->route( 'user' ) == $user->id || parent::authorize();
        }

        return parent::authorize();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => [
                'required',
                'min:3',
                'max:140'
            ],
            'email' => [
                'required',
                'max:140'
            ],
            'description' => [
                'required',
                'max:500'
            ],

        ];

    }
}
