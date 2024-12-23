<?php

namespace App\Http\Controllers\SupportTeam;

use App\Helpers\Qs;
use App\Http\Requests\MyClass\ClassCreate;
use App\Http\Requests\MyClass\ClassUpdate;
use App\Repositories\MyClassRepo;
use App\Repositories\SchoolRepo;
use App\Repositories\UserRepo;
use App\Http\Controllers\Controller;

class MyClassController extends Controller
{
    protected $my_class, $user, $school;

    public function __construct(MyClassRepo $my_class, UserRepo $user, SchoolRepo $school)
    {
        $this->middleware('teamSA', ['except' => ['destroy',] ]);
        $this->middleware('super_admin', ['only' => ['destroy',] ]);

        $this->school = $school;
        $this->my_class = $my_class;
        $this->user = $user;
    }

    public function index()
    {
        $d['my_classes'] = $this->my_class->all();
        $d['class_types'] = $this->my_class->getTypes();

        return view('pages.support_team.classes.index', $d);
    }

    public function store(ClassCreate $req)
    {
        $data = $req->all();
        $mc = $this->my_class->create($data);

        // Create Default Section
        $s =['my_class_id' => $mc->id,
            'name' => 'A',
            'active' => 1,
            'teacher_id' => NULL,
        ];

        $this->my_class->createSection($s);

        return Qs::jsonStoreOk();
    }

    public function edit($id)
    {
        $d['c'] = $c = $this->my_class->find($id);

        return is_null($c) ? Qs::goWithDanger('classes.index') : view('pages.support_team.classes.edit', $d) ;
    }

    public function update(ClassUpdate $req, $id)
    {
        $data = $req->only(['name']);
        $this->my_class->update($id, $data);

        return back()->with('flash_success', __('msg.update_ok'));
    }

    public function destroy($id)
    {
        $this->my_class->delete($id);
        return back()->with('flash_success', __('msg.del_ok'));
    }

    public function listClassBySchool($school_id)
    {
        $d['school'] = $this->school->find($school_id);
        $d['my_classes'] = $this->my_class->getByCondition(['school_id' => $school_id]);
        $d['class_types'] = $this->my_class->getTypes();

        return view('pages.support_team.classes.listBySchool', $d);
    }

    public function listSections($class_id)
    {
        $d['my_class'] = $this->my_class->find($class_id);
        $d['school'] = $this->school->find($d['my_class']->school_id);
        $d['sections'] = $this->my_class->getClassSections($class_id);
        $d['teachers'] = $this->user->getUserByTypeAndSchool('teacher', $d['my_class']->school_id);
        $d['class_types'] = $this->my_class->getTypes();

        return view('pages.support_team.classes.listSections', $d);
    }

}
