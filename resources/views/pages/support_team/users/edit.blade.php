@extends('layouts.master')
@section('page_title', 'Thay đổi thông tin người dùng')
@section('content')

    <div class="card">
        <div class="card-header header-elements-inline">
            <h6 class="card-title">Thông tin chi tiết</h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <form method="post" enctype="multipart/form-data" class="wizard-form steps-validation ajax-update" action="{{ route('users.update', Qs::hash($user->id)) }}" data-fouc>
                @csrf @method('PUT')
                <h6>Personal Data</h6>
                <fieldset>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_type"> Trường / Trung tâm: <span
                                        class="text-danger">*</span></label>
                                <select required data-placeholder="Select User" class="form-control select"
                                        name="school_id" id="school_id">
                                    @foreach($schools as $ut)
                                        <option value="{{ Qs::hash($ut->id) }}">{{ $ut->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_type"> Loại tài khoản: <span
                                        class="text-danger">*</span></label>
                                <select required data-placeholder="Select User" class="form-control select"
                                        name="user_type" id="user_type">
                                    @foreach($user_types as $ut)
                                        <option {{ $ut->title == $user->user_type ? 'selected' : '' }} value="{{ Qs::hash($ut->id) }}">{{ $ut->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Họ và tên: <span class="text-danger">*</span></label>
                                <input value="{{ $user->name }}" required type="text" name="name"
                                       placeholder="Full Name" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Địa chỉ: <span class="text-danger">*</span></label>
                                <input value="{{ $user->address }}" class="form-control" placeholder="Address"
                                       name="address" type="text" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email: </label>
                                <input value="{{ $user->email }}" type="email" name="email" class="form-control"
                                       placeholder="your@email.com">
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Phone:</label>
                                <input value="{{ $user->phone }}" type="text" name="phone" class="form-control"
                                       placeholder="+2341234567">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telephone:</label>
                                <input value="{{ $user->phone2 }}" type="text" name="phone2"
                                       class="form-control" placeholder="+2341234567">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-block">Avatar:</label>
                                <input value="{{ $user->photo }}" accept="image/*" type="file" name="photo"
                                       class="form-input-styled" data-fouc>
                                <span
                                    class="form-text text-muted">Accepted Images: jpeg, png. Max file size 2Mb</span>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ngày bắt đầu làm việc:</label>
                                <input autocomplete="off" name="emp_date" value="{{ $user->emp_date }}"
                                       type="text" class="form-control date-pick" placeholder="Select Date...">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender">Giới tính: <span class="text-danger">*</span></label>
                                <select class="select form-control" id="gender" name="gender" required data-fouc
                                        data-placeholder="Choose..">
                                    <option value=""></option>
                                    <option {{ ($user->gender == 'Male') ? 'selected' : '' }} value="Male">Nam
                                    </option>
                                    <option {{ ($user->gender == 'Female') ? 'selected' : '' }} value="Female">
                                        Nữ
                                    </option>
                                </select>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên đăng nhập: </label>
                                <input value="{{ $user->username }}" type="text" name="username"
                                       class="form-control" placeholder="Username">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Mật khẩu mới: </label>
                                <input id="password" type="password" name="new_password" class="form-control">
                            </div>
                        </div>
                    </div>

                </fieldset>
            </form>
        </div>

    </div>
@endsection
