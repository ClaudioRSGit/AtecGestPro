 <p align="center"><img src="https://laravel.com/img/logomark.min.svg" width="200"></p>
 <p align="center"><img src="https://laravel.com/img/logotype.min.svg" width="200"></p>

### Laravel Documentation: [Official Website](https://laravel.com/)

---

<br>

# Request Files

<br>

## What are Request Files <img src="https://pngimg.com/d/question_mark_PNG56.png" width="50" >

<p>
Request files in Laravel are classes designed to encapsulate and centralize data validation logic for input received by the application. These classes, often generated using Artisan commands, extend the FormRequest class and streamline the validation process.
</p>

<br>

# Advantages of Request Files <img src="https://www.pngall.com/wp-content/uploads/9/Green-Tick-Vector-PNG-Image-HD.png" width="50" >

<br>

## Separation of Concerns <img src="https://cdn-icons-png.flaticon.com/512/1420/1420308.png" width="50" >

<p>
Request files maintain a clear separation of concerns. Validation logic is isolated in dedicated classes, allowing controllers to focus on executing actions without the distraction of validation code.
</p>

<br>

## Reuse of Validation Rules <img src="https://static.vecteezy.com/system/resources/thumbnails/008/506/456/small/recycling-green-icon-3d-sign-illustration-free-png.png" width="50" >

<p>
By defining validation rules in a Request file, you can reuse them across different parts of the application, promoting consistency and avoiding code duplication.
</p>

<br>

## Code Readability <img src="https://upload.wikimedia.org/wikipedia/commons/e/e8/Power_Clean_Ico.png" width="50" >

<p>
Request files enhance code readability by keeping controller code clean and focused on business logic, while validation rules are managed in separate classes.
</p>

<br>

## Ease of Customizing Error Messages <img src="https://cdn3d.iconscout.com/3d/premium/thumb/report-customization-6345838-5231408.png" width="50" >

<p>
Request files enable the customization of error messages for each validation rule, providing user-friendly feedback and precise information about input issues.
</p>

<br>

## Centralized Validation Logic <img src="https://www.gov.br/prf/pt-br/media/map-2.png/@@images/image.png" width="50" >

<p>
Centralizing validation logic in Request files simplifies maintenance and updates, as all changes can be made in one location.
</p>

<br>

# Summary

<p>
Laravel Request files offer a structured and efficient approach to handle input validation, improving code organization, promoting reuse, and facilitating application maintenance. This practice contributes to the development of more robust and flexible systems.
</p>

<br>

# Creating request file

```shell
php artisan make:request RequestName
```

<br>

## Example of empety request file

```shell
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExampleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
```

<br>

## Authorize <img src="https://cdn-icons-png.flaticon.com/512/4413/4413727.png" width="50" >

```shell
 public function authorize()
{
    return false;
}
```

<p>
The authorize method in a Laravel Request file is used to determine if the current user has permission to perform the request. Returning true means the request is authorized, while false means it's not. If you use "return false;", it defaults to denying authorization for all instances of that Request. This can be helpful when you want to explicitly control permissions in a specific method or handle authorization elsewhere in your code.
In the specific case of the AtecGestPro application, it will always return true because access permissions are being controlled through middleware and protected routes.
</p>
<p>
In the specific case of the AtecGestPro application, it will always return true because access permissions are being controlled through middleware and protected routes.
</p>

<br>

## Rules <img src="https://www.pngall.com/wp-content/uploads/9/Legal-Hammer-PNG-HD-Image.png" width="50" >

```shell
public function rules()
{
    return [
         //
     ];
}
```

<p>
The rules method in a Laravel Request file is used to define validation rules for the incoming request data. It specifies the conditions that the data must meet to be considered valid.
</p>

<br>

## User rules (example)

```shell
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
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
        #  Set $userId to the authenticated user's ID if available, or null if not.
        #  This is used in validation rules to exclude the current user during unique checks,
        #  allowing updates without triggering unique constraints on the current user's data.

        $userId = $this->user ? $this->user->id : null;

        # Validation rules for user data

        $rules = [
            'name' => 'required|string|min:3|max:200',
            'username' => ['required', 'string', 'min:5', 'max:20', 'unique:users,username,' . $userId],
            'email' => ['required', 'email', 'unique:users,email,' . $userId],
            'contact' => ['required', 'min:9', 'max:20', 'regex:/^[\s\d()+-]+$/', 'unique:users,contact,' . $userId],
            'isStudent' => 'required',
            'isActive' => 'required',
            'course_class_id' => 'nullable',
            'role_id' => 'required',
        ];


        # Conditional validation for the 'password' field:
        # If the HTTP method is 'PUT':
        # - 'password' validation is based on its presence or absence in the request.
        # If the HTTP method is not 'PUT' (likely 'POST'):
        # - 'password' validation depends on the 'isStudent' field.

        if ($this->isMethod('put')) {
            $rules['password'] = [
                'nullable',
                'string',
                'min:7',
                'max:20',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).*$/',
            ];
        } else {
            $rules['password'] = [
                $this->input('isStudent') == 1 ? 'nullable' : 'required',
                'string',
                'min:7',
                'max:20',
                'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).*$/',
            ];
        }

        return $rules;
    }

    # Custom error messages for validation rules.

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório!',
            'name.min' => 'O nome deve ter pelo menos 5 caracteres!',
            'name.max' => 'O nome deve ter no máximo 200 caracteres!',

            'username.required' => 'O username é obrigatório!',
            'username.min' => 'O username deve ter pelo menos 5 caracteres!',
            'username.max' => 'O username deve ter no máximo 20 caracteres!',
            'username.unique' => 'O username já existe!',

            'email.required' => 'O email é obrigatório!',
            'email.email' => 'Formato de email inválido!',
            'email.unique' => 'O email já existe!',

            'contact.required' => 'O contato é obrigatório!',
            'contact.min' => 'O contato deve ter pelo menos 9 caracteres!',
            'contact.max' => 'O contato deve ter no máximo 20 caracteres!',
            'contact.regex' => 'Formato de contacto inválido!',
            'contact.unique' => 'O contacto já existe!',

            'password.required' => 'A password é obrigatória!',
            'password.regex' => 'A password deve ter pelo menos uma letra maiúscula, um caracter especial e sete caracteres!',
            'password.min' => 'A password deve ter pelo menos uma letra maiúscula, um caracter especial e sete caracteres!',
            'password.max' => 'A password deve no máximo vinte caracteres!',
        ];
    }
}

```

<br>

## Store method before creating the UserRequest file

```shell
 public function store(Request $request)
 {
    ... Existing code ...

    try {
            $request->validate([
                'name' => 'required|string|min:3|max:200',
                'username' => 'required|string|min:5|max:20',
                'email' => [
                    'required',
                    'email',
                ],
                'contact' => 'required|min:9|max:20',
                'password' => [
                    $request->input('password') != null ? 'required' : 'nullable',
                    'string',
                    'min:7',
                    'regex:/^(?=.*[A-Z])(?=.*[!@#$%^&*(),.?":{}|<>]).*$/',
                ],

                'isStudent' => 'required',
                'isActive' => 'required',
                'course_class_id' => 'nullable',
                'role_id' => 'required',
            ]);

            ... Existing code ...
        }
    ... Existing code ...
 }
```

<br>

## To use the created request file, it is necessary to import it into our controller

```shell
<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\CourseClass;
use App\Course;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
```

<br>

## Store method after creating the UserRequest file

```shell
 public function store(UserRequest $request)
 {
    ... Existing code ...

    $userData = $request->validated();

    ... Existing code ...
 }
```

<br>

## Custom error messages <img src="https://cdn.staticcrate.com/stock-hd/effects/footagecrate-red-error-icon@3X.png" width="50" >

<p>
As demonstrated in the UserRequest file, it is possible to add a section for custom error messages for each individual validation.
</p>

<br>

## In our view <img src="https://i.pinimg.com/originals/4c/5c/4b/4c5c4b09c649656cb24f69259e804145.png" width="50" >

<p>
In our view, it is possible to add a code section wherever we want to display errors for a specific field. By passing the correct field name, all error messages defined in the request file for that field will be shown in the location where the error code snippet is added.
</p>

```shell
<div class="mb-3">
    <label for="name" class="form-label">Nome do Utilizador:</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">

    @error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
```
