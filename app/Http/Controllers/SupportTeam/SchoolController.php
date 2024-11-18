<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Controllers\Controller;
use App\Repositories\schoolRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SchoolController extends Controller
{
    protected  $school;

    public function __construct(SchoolRepo $school)
    {
        $this->middleware('teamSA', ['except' => ['destroy',] ]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->school = $school;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $d['schools'] = $this->school->getAll();
        return view('pages.support_team.schools.index', $d);
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

        if($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $f = Qs::getFileMetaData($photo);
            $f['name'] = $f['name'].'.'. $f['ext'];
            $f['path'] = $photo->storeAs('uploads/school/', $f['name']);
            $data['logo'] = asset('storage/' . $f['path']);
        }

        $school = $this->school->create($data);

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
        $d['s'] = $sub = $this->school->find($id);

        return is_null($sub) ? Qs::goWithDanger('schools.index') : view('pages.support_team.schools.edit', $d);
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
            $f['path'] = $photo->storeAs('uploads/school/', $f['name']);
            $data['logo'] = asset('storage/' . $f['path']);
        }

        $this->school->update($id, $data);

        return redirect()->route('schools.index')->with('flash_success', __('msg.update_ok'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->school->find($id)->delete();

        return back()->with('flash_success', __('msg.delete_ok'));
    }
}
