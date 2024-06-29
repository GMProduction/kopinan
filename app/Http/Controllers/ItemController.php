<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    public function datatable(){
        $item = Item::query();

        return DataTables::of($item)
                         ->make(true);
    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application|JsonResponse
     */
    public function index(){
        if (request()->method() == 'POST'){
            return  $this->postData();
        }
        return view('item.index');
    }

    public function postData() {
        $field = request()->validate([
            'category_id' => 'required',
            'name' => 'required',
            'price' => 'required',
        ]);

        try {
            if (request('image')) {
                $image     = $this->generateImageName('image');
                $stringImg = '/images/menu/'.$image;
                $this->uploadImage('image', $image, 'imageMenu');
                Arr::set($field, 'image', $stringImg);
            }
            if (request('id')){
                $item = Item::find(request('id'));
                if (request('image') && $item->image) {
                    if (file_exists('../public'.$item->image)) {
                        unlink('../public'.$item->image);
                    }
                }
                $item->update($field);
            }else{
                $item = new Item();
                $item->create($field);
            }
            return response()->json([
                'payload' => $item,
                'message' => 'success',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * @param $id
     *
     * @return string
     */
    public function delete()
    {
        $id = request('id');
        Item::where('id', '=', $id)->delete();

        return 'berhasil';
    }

    /**
     * @param $field
     * @param $targetName
     * @param $disk
     *
     * @return bool
     */
    public function uploadImage($field, $targetName = '', $disk = 'upload')
    {
        $file = request()->file($field);

        return Storage::disk($disk)->put($targetName, File::get($file));
    }

    /**
     * @param $field
     *
     * @return string
     */
    public function generateImageName($field = '')
    {
        $value = '';
        if (request()->hasFile($field)) {
            $files     = request()->file($field);
            $extension = $files->getClientOriginalExtension();
            $name      = $this->uuidGenerator();
            $value     = $name.'.'.$extension;
        }

        return $value;
    }

    /**
     * @return string
     */
    public function uuidGenerator()
    {
        return Uuid::uuid1()->toString();
    }


}
