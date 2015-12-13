<?php

namespace App\Http\Requests;


class CommandLineRequest extends Request
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
    protected $error_msg = "edit password";


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        $user = auth()->user();

        if ($user)
        {

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
            'password' => [
                'required',
                'max:140',
                'min:6'
            ],
            'new_password' => [
                'required',
                'regex:/^(?:[0-9]+[a-zA-Z]|[a-zA-Z]+[0-9])[a-z0-9]*$/',
                'max:140',
                'different:password'
            ],
            'verify_password' => [
                'required',
                'same:new_password'
            ],

        ];

    }
}
