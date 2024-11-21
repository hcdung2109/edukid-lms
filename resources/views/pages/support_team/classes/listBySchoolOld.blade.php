@extends('layouts.master')
@section('page_title', 'Manage Classes')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title text-bold"><i class="icon-plus-circle2"></i> Thêm lớp</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <form class="ajax-store" method="post" action="{{ route('classes.store') }}">
                <div class="row">
                    <div class="col-md-6">
                        @csrf
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Trường / Trung tâm<span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="school_id" value="{{ $school->id }}" required type="hidden" class="form-control"
                                       placeholder="">
                                <input value="{{ $school->name }}"  class="form-control" disabled style="font-weight: bold; color: black">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Tên lớp <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="name" value="{{ old('name') }}" required type="text" class="form-control"
                                       placeholder="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="class_type_id" class="col-lg-3 col-form-label font-weight-semibold">Trạng thái</label>
                            <div class="col-lg-9">
                                <select required data-placeholder="Select Class Type" class="form-control select" name="status" id="status">
                                    <option value="0">Chưa bắt đầu</option>
                                    <option value="1">Đang học</option>
                                    <option value="2">Đã kết thúc</option>
                                    <option value="3">Tạm dừng</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-right">
                            <button id="ajax-btn" type="submit" class="btn btn-primary">Lưu <i
                                    class="icon-paperplane ml-2"></i></button>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <p class="text-bold">Khóa học</p>
                        @foreach($class_types as $ct)
                            <input type="radio" id="class_type_id" name="class_type_id" value="{{ $ct->id }}">
                            <label for="age1" class="text-bold">{{ $ct->name }}</label><br>
                        @endforeach
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title text-bold">Danh sách lớp học</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <table class="table datatable-button-html5-columns">
                <thead>
                <tr>
                    <th>TT</th>
                    <th>Name</th>
                    <th>Class Type</th>
                    <th>Hành Động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($my_classes as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c->name }}</td>
                        <td>{{ $c->class_type->name }}</td>
                        <td class="text-center">
                            <div class="list-icons">
                                <div class="dropdown">
                                    <a href="#" class="list-icons-item" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-left">
                                        @if(Qs::userIsTeamSA())
                                            {{--Edit--}}
                                            <a href="{{ route('classes.edit', $c->id) }}" class="dropdown-item"><i
                                                    class="icon-trash"></i> Chỉnh sửa</a>
                                        @endif
                                        @if(Qs::userIsSuperAdmin())
                                            {{--Delete--}}
                                            <a id="{{ $c->id }}" onclick="confirmDelete(this.id)" href="#"
                                               class="dropdown-item"><i class="icon-trash"></i> Xóa</a>
                                            <form method="post" id="item-delete-{{ $c->id }}"
                                                  action="{{ route('classes.destroy', $c->id) }}"
                                                  class="hidden">@csrf @method('delete')</form>
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
