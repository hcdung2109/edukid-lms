<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Repositories\BookRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{
    protected  $book;

    public function __construct(BookRepo $book)
    {
        $this->book = $book;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d['books'] = $this->book->getAll();
        return view('pages.support_team.books.index', $d);
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
    public function store(Request $req)
    {
        $data = $req->all();

        $cate = Category::find($req->category_id);

        Storage::makeDirectory('files/'.$cate->name.'/'.$req->name);

        if($req->hasFile('document')) {
            $file = $req->file('document');
            $f = Qs::getFileMetaData($file);
            $f['name'] = $req->name.'.'. $f['ext'];
            $f['path'] = $file->storeAs('files/'.$cate->name.'/'.$req->name, $f['name']);
            $data['document'] = $f['path'];
        }

        $book = $this->book->create($data);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $d['s'] = $sub = $this->book->find($id);

        return is_null($sub) ? Qs::goWithDanger('books.index') : view('pages.support_team.books.edit', $d);
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

        if($req->hasFile('document')) {
            $file = $req->file('document');
            $f = Qs::getFileMetaData($file);
            $f['name'] = $f['name'].'.'. $f['ext'];
            $f['path'] = $file->storeAs('uploads/book/', $f['name']);
            $data['logo'] = $f['path'];
        }

        $this->book->update($id, $data);

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
        $this->book->find($id)->delete();

        return back()->with('flash_success', __('msg.delete_ok'));
    }

    public function viewDocument($id)
    {
        $book = Book::find(9);

        $filePath = storage_path('files/7.png');
        //$filePath = realpath($filePath);

// Debugging
        dd([
            'filePath' => $filePath,
            'realpath' => realpath($filePath),
            'file_exists' => file_exists($filePath),
            'is_readable' => is_readable($filePath),
        ]);

        if (!file_exists($filePath)) {
            abort(404, 'File not found.');
        }

// If file exists, proceed to serve it
        return response()->file($filePath, [
            'Content-Disposition' => 'inline',
            'Content-Type' => mime_content_type($filePath),
        ]);
    }
}
