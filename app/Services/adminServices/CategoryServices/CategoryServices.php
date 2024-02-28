<?php
// namespace App\Services;
namespace App\Services\adminServices\CategoryServices;

use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UserLoginRequest as AdminLoginRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Empolyee;
use App\Models\User;
use Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\DB;

class CategoryServices
{
    use GeneralTrait;

    public function create(CategoryRequest $request)
    {

            $category=Category::create($request->validated());
            return $category;
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
return $category;
}
    public function edit(CategoryRequest $request,$id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());
        return $category;
        //

    }
}
