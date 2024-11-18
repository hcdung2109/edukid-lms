<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\BookRepo;
use App\Repositories\categoryRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    protected  $category, $book;

    public function __construct(CategoryRepo $category, BookRepo $book)
    {
        //$this->middleware('teamSA', ['except' => ['destroy',] ]);
        //$this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->category = $category;
        $this->book = $book;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d['categories'] = $this->category->getAll();
        return view('pages.support_team.categories.index', $d);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        Storage::makeDirectory('files/'.$data['name']);

        $category = $this->category->create($data);

        return Qs::jsonStoreOk();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d['s'] = $sub = $this->category->find($id);
        $d['books'] = $this->book->getBook(['category_id' => $id]);

        return is_null($sub) ? Qs::goWithDanger('categories.index') : view('pages.support_team.categories.edit', $d);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $data = $req->all();

        if($req->hasFile('photo')) {
            $photo = $req->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = $f['name'].'.'. $f['ext'];
            $f['path'] = $photo->storeAs('uploads/category/', $f['name']);
            $data['logo'] = asset('storage/' . $f['path']);
        }

        $this->category->update($id, $data);

        //return back()->with('flash_success', __('msg.update_ok'));

        return Qs::jsonUpdateOk();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Category::find($id);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Item deleted successfully'], 200);
    }
}
