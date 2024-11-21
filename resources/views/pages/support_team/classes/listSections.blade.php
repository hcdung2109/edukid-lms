@extends('layouts.master')
@section('page_title', 'Quản Lý Khóa Học')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Thêm khóa học</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="ajax-store" method="post" action="{{ route('sections.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Trường / Trung Tâm<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="hidden" value="{{ $school->id }}" name="school_id">
                                <input disabled type="text" value="{{ $school->name }}" class="form-control text-bold" style="color: black">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Lớp<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="hidden" value="{{ $my_class->id }}" name="my_class_id">
                                <input disabled type="text" value="{{ $my_class->name }}" class="form-control text-bold" style="color: black">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">Trạng thái</label>
                            <div class="col-lg-9">
                                <select required data-placeholder="Select Class Type" class="form-control select" name="status" id="status">
                                    <option value="-1">(Trống)</option>
                                    <option value="0">Chưa bắt đầu</option>
                                    <option value="1">Đang học</option>
                                    <option value="2">Đã kết thúc</option>
                                    <option value="3">Tạm dừng</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="teacher_id" class="col-lg-3 col-form-label font-weight-semibold">Giáo Viên</label>
                            <div class="col-lg-9">
                                <select data-placeholder="Chọn" class="form-control select-search" name="teacher_id" id="teacher_id">
                                    <option value=""></option>
                                    @foreach($teachers as $t)
                                        <option {{ old('teacher_id') == Qs::hash($t->id) ? 'selected' : '' }} value="{{ Qs::hash($t->id) }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Ngày bắt đầu</label>
                            <div class="col-lg-9">
                                <input type="date" value="{{ date('Y-m-d') }}" name="my_class_id">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Ngày kết thúc</label>
                            <div class="col-lg-9">
                                <input type="date" value="" name="my_class_id">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Ghi chú</label>
                            <div class="col-lg-9">
                                <textarea name="note" rows="5" style="width: 100%"></textarea>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Lưu <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <p class="text-bold">Học Sinh</p>
                    <div class="treeselect-demo"></div>
                    <hr>
                    <p class="text-bold">Khóa học</p>
                    @foreach($class_types as $ct)
                        <input type="radio" id="class_type_id" name="class_type_id" value="{{ $ct->id }}">
                        <label for="age1" class="">{{ $ct->name }}</label><br>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table datatable-button-html5-columns">
                <thead>
                <tr>
                    <th>TT</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Teacher</th>
                    <th>Hành Động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sections as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->name }} @if($s->active)<i class='icon-check'> </i>@endif</td>
                        <td>{{ $s->my_class->name }}</td>

                        @if($s->teacher_id)
                            <td><a target="_blank" href="{{ route('users.show', Qs::hash($s->teacher_id)) }}">{{ $s->teacher->name }}</a></td>
                        @else
                            <td> - </td>
                        @endif

                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-left">
                                        {{--edit--}}
                                        @if(Qs::userIsTeamSA())
                                            <a href="{{ route('sections.edit', $s->id) }}" class="dropdown-item"><i class="icon-trash"></i> Chỉnh sửa</a>
                                        @endif
                                        {{--Delete--}}
                                        @if(Qs::userIsSuperAdmin())
                                            <a id="{{ $s->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Xóa</a>
                                            <form method="post" id="item-delete-{{ $s->id }}" action="{{ route('sections.destroy', $s->id) }}" class="hidden">@csrf @method('delete')</form>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const options = [
            {
                name: 'England',
                value: 1,
                children: [
                    {
                        name: 'London',
                        value: 2,
                        children: [
                            {
                                name: 'Chelsea',
                                value: 3,
                                children: []
                            },
                            {
                                name: 'West End',
                                value: 4,
                                children: []
                            }
                        ]
                    },
                    {
                        name: 'Brighton',
                        value: 5,
                        children: []
                    }
                ]
            },
            {
                name: 'France',
                value: 6,
                children: [
                    {
                        name: 'Paris',
                        value: 7,
                        children: []
                    },
                    {
                        name: 'Lyon',
                        value: 8,
                        children: []
                    }
                ]
            }
        ]

        // Use slot if you need
        const slot = document.createElement('div')
        slot.innerHTML='<a class="treeselect-demo__slot" href="">Click!</a>'

        const domElement = document.querySelector('.treeselect-demo')
        const treeselect = new Treeselect({
            parentHtmlContainer: domElement,
            value: [],
            options: options,
            listSlotHtmlComponent: slot
        })

        treeselect.srcElement.addEventListener('input', (e) => {
            console.log('Selected value:', e.detail)
        })

        slot.addEventListener('click', (e) => {
            e.preventDefault()
            alert('Slot click!')
        })
    </script>
@endsection
