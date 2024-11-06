@extends('layouts.master')
@section('page_title', 'Chỉnh sửa - '.$s->name)
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Chỉnh sửa </h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form class="ajax-update" method="post" action="{{ route('books.update', $s->id) }}">
                        @csrf @method('PUT')
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Tên trường / Trung tâm <span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input name="name" value="{{ $s->name }}" required type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Email</label>
                            <div class="col-lg-9">
                                <input name="email" value="{{ $s->email }}"  type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">SĐT</label>
                            <div class="col-lg-9">
                                <input name="phone" value="{{ $s->phone }}"  type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label font-weight-semibold">Địa chỉ</label>
                            <div class="col-lg-9">
                                <input name="address" value="{{ $s->address }}"  type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-lg-3 col-form-label font-weight-semibold">Logo</label>
                            <div class="col-lg-9">
                                <input  accept="image/*" type="file" name="photo" class="form-input-styled" data-fouc>

                                <img src="{{ $s->logo }}" width="150px"  style="margin: 15px" />
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

    {{--subject Edit Ends--}}

@endsection
