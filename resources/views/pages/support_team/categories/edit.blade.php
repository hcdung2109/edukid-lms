@extends('layouts.master')
@section('page_title', 'Danh Sách Bài Học')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title text-bold"><i class="icon-plus-circle2"></i> Thêm mới bài học</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="ajax-update" method="post" action="{{ route('books.store') }}">
                        @csrf
                        <input type="hidden" name="category_id" value="{{ $s->id }}">

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Tên Bài Học <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="name" value="" required type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Mô tả</label>
                            <div class="col-lg-9">
                                <textarea name="description" rows="5" style="width: 100%"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-lg-3 col-form-label font-weight-semibold">File tài liệu</label>
                            <div class="col-lg-9">
                                <input type="file" name="document" class="form-input-styled" data-fouc>
                            </div>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Lưu <i class="icon-paperplane ml-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title"></h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-book" class="nav-link active" data-toggle="tab">Danh sách bài học</a></li>
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
                        @foreach($books as $d)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $d->name }}</td>
                                <td class="text-center">
                                    <a style="" href="{{ route('books.show', $d->id) }}" class="btn btn-primary"><i class="fa fa-link"></i>Xem giáo trình</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
