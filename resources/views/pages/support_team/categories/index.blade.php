@extends('layouts.master')
@section('page_title', 'Quản Lý Tài Liệu')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title"></h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-book" class="nav-link active" data-toggle="tab">Giáo Trình</a></li>
                <li class="nav-item"><a href="#cong-van" class="nav-link" data-toggle="tab">Tài liệu nội bộ</a></li>
                <li class="nav-item"><a href="#new-dorm" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Thêm mới tài liệu</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-book">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>TT</th>
                                <th>Tên</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td class="text-center">
                                        <a style="" href="{{ route('categories.edit', $d->id) }}" class="btn btn-primary">Danh Sách Bài Học</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="Công văn">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>TT</th>
                                <th>Tên</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td class="text-center">
                                        <a style="" href="{{ route('categories.edit', $d->id) }}" class="btn btn-primary">Danh Sách Bài Học</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                <div class="tab-pane fade" id="new-dorm">

                    <div class="row">
                        <div class="col-md-6">
                            <form class="ajax-store" method="post" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Tên tài liệu <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="name" value="{{ old('name') }}" required type="text" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="my_class_id" class="col-lg-3 col-form-label font-weight-semibold">Loại tài liệu</label>
                                    <div class="col-lg-9">
                                        <select required data-placeholder="Select Class" class="form-control select" name="my_class_id" id="my_class_id">
                                            <option>Giáo Trình</option>
                                            <option>Tài liệu nội bộ</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Ngày phát hành<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="name" value="{{ old('name') }}" required type="date" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Mô tả</label>
                                    <div class="col-lg-9">
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                </div>


                                <div class="text-right">
                                    <button id="ajax-btn" type="submit" class="btn btn-primary">Lưu <i class="icon-paperplane ml-2"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--Dorm List Ends--}}

@endsection
