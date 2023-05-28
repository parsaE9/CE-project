<?php

namespace App\Http\Controllers\V1;

use App\Helpers\FileHelper;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequestt;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductUpdateStatusRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_unless($request->has('user_id'), 404);
        return ProductResource::collection(Product::query()->where('status' , Product::STATUS_PUBLISH)->where('user_id' , $request->get('user_id'))->paginate());

        return ProductResource::collection(Product::query()->where('user_id' , Auth::guard('api')->user()->id)->paginate());
    }

    public function myIndex(Request $request)
    {
        return ProductResource::collection(Product::query()->where('user_id' , Auth::id())->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return ProductResource
     */
    public function store(ProductStoreRequestt $request)
    {
        PermissionHelper::abort_if_unless_permission('product_create');
        FileHelper::UploadAllowFields($request, ['data']);
        return new ProductResource(Product::create([
            'user_id' => Auth::id(),
            'status' => Product::STATUS_DRAFT,
            'name' => $request->get('name'),
            'data' => $request->get('data'),
        ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ProductResource
     */
    public function show($id)
    {
        return new ProductResource(Product::query()->where('status' , Product::STATUS_PUBLISH)->where('id' , $id)->firstOrFail());
    }

    public function showForEdit($id)
    {
        $model = Product::query()->where('id' , $id)->firstOrFail();
        PermissionHelper::abort_if_unless_admin_or_permmition_with_own_model('product_edit' ,'product_edit_own' , $model);
        return new ProductResource($model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $model = Product::query()->where('id' , $id)->firstOrFail();
        PermissionHelper::abort_if_unless_admin_or_permmition_with_own_model('product_update' ,'product_update_own' , $model);
        FileHelper::UploadAllowFields($request, ['data']);
        $model->fill($request->only('data', 'name'));
        $model->save();
        return new ProductResource($model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Product::query()->where('id' , $id)->firstOrFail();
        PermissionHelper::abort_if_unless_admin_or_permmition_with_own_model('product_delete' ,'product_delete_own' , $model);
        return $model->delete();
    }

    public function updateStatus($id , ProductUpdateStatusRequest $request)
    {
        $model = Product::query()->where('id' , $id)->firstOrFail();
        PermissionHelper::abort_if_unless_admin_or_permmition_with_own_model('product_update_status' ,'product_update_status_own' , $model);
        $model->status = $request->get('status');
        $model->save();
        return new ProductResource($model);
    }
}
