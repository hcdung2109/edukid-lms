@extends('layouts.master')
@section('page_title', 'Quản Lý Trường / Trung Tâm')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Danh sách Trường / Trung tâm</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <ul class="nav nav-tabs nav-tabs-highlight">
                <li class="nav-item"><a href="#all-school" class="nav-link active" data-toggle="tab">Danh sách</a></li>
                <li class="nav-item"><a href="#new-dorm" class="nav-link" data-toggle="tab"><i class="icon-plus2"></i> Thêm mới</a></li>
            </ul>

            <div class="tab-content">
                    <div class="tab-pane fade show active" id="all-school">
                        <table class="table datatable-button-html5-columns">
                            <thead>
                            <tr>
                                <th>TT</th>
                                <th>Trường / Trung tâm</th>
                                <th>Email</th>
                                <th>SĐT</th>
                                <th>Địa chỉ</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schools as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->name }}</td>
                                    <td>{{ $d->email}}</td>
                                    <td>{{ $d->phone}}</td>
                                    <td>{{ $d->address}}</td>
                                    <td class="text-center">
                                        <div class="list-icons">
                                            <div class="dropdown">
                                                <a href="#" class="list-icons-item" data-toggle="dropdown">
                                                    <i class="icon-menu9"></i>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-left">
                                                    @if(Qs::userIsTeamSA())
                                                    {{--Edit--}}
                                                    <a href="{{ route('schools.edit', $d->id) }}" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                   @endif
                                                        @if(Qs::userIsSuperAdmin())
                                                    {{--Delete--}}
                                                    <a id="{{ $d->id }}" onclick="confirmDelete(this.id)" href="#" class="dropdown-item"><i class="icon-trash"></i> Delete</a>
                                                    <form method="post" id="item-delete-{{ $d->id }}" action="{{ route('schools.destroy', $d->id) }}" class="hidden">@csrf @method('delete')</form>
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

                <div class="tab-pane fade" id="new-dorm">

                    <div class="row">
                        <div class="col-md-6">
                            <form class="ajax-store" method="post" action="{{ route('schools.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Tên trường / Trung tâm <span class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="name" value="{{ old('name') }}" required type="text" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Email</label>
                                    <div class="col-lg-9">
                                        <input name="email" value="{{ old('email') }}"  type="text" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">SĐT</label>
                                    <div class="col-lg-9">
                                        <input name="phone" value="{{ old('email') }}"  type="text" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Địa chỉ</label>
                                    <div class="col-lg-9">
                                        <input name="address" value="{{ old('email') }}"  type="text" class="form-control" >
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-lg-3 col-form-label font-weight-semibold">Logo</label>
                                    <div class="col-lg-9">
                                        <input  accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>
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