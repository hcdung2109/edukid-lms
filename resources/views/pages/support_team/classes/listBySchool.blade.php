@extends('layouts.master')
@section('page_title', 'Danh Sách Lớp Học')
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

                        <div class="text-right">
                            <button id="ajax-btn" type="submit" class="btn btn-primary">Lưu <i
                                    class="icon-paperplane ml-2"></i></button>
                        </div>
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
                    <th>Tên lớp</th>
                </tr>
                </thead>
                <tbody>
                @foreach($my_classes as $c)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $c->name }}</td>
                        <td class="text-center">
                            <a href="{{ route('classes.list.sections', ['class_id' => $c->id]) }}" class="btn btn-warning"><i class="icon-table2"></i> Danh Sách Khóa Học</a>

                            @if(Qs::userIsTeamSA())
                                {{--Edit--}}
                                <a href="{{ route('classes.edit', $c->id) }}" class="btn btn-primary"><i
                                        class="icon-pencil"></i> Chỉnh sửa</a>
                            @endif
                            @if(Qs::userIsSuperAdmin())
                                {{--Delete--}}
                                <a id="{{ $c->id }}" onclick="confirmDelete(this.id)" href="#"
                                   class="btn btn-danger"><i class="icon-trash"></i> Xóa</a>
                                <form method="post" id="item-delete-{{ $c->id }}"
                                      action="{{ route('classes.destroy', $c->id) }}"
                                      class="hidden">@csrf @method('delete')</form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
