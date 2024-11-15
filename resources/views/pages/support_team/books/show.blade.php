@extends('layouts.master')
@section('page_title', 'Danh Sách Files')
@section('content')

    <div class="card" style="width: 50%">
        <div class="card-header header-elements-inline">
            <h6 class="card-title"></h6>
            {!! Qs::getPanelOptions() !!}
        </div>

        <div class="card-body">
            <table class="table border">
                <tbody>
                    @foreach($files as $file)
                        @php
                            $extension = pathinfo(basename($file), PATHINFO_EXTENSION);
                        @endphp

                        <tr>
                            <td style="width: 50px;">
                                @if($extension == 'pdf')
                                    <i class="icon-file-pdf" style="font-size: 2rem; color: deeppink"></i>
                                @endif

                                @if(in_array($extension, ['png','jpg','jpeg','gif']))
                                    <i class="icon-image2" style="font-size: 2rem; color: darkcyan"></i>
                                @endif

                                @if(in_array($extension, ['doc','docx']))
                                    <i class="icon-file-word" style="font-size: 2rem; color: #0aa7ef"></i>
                                @endif

                                @if($extension == 'xlsx')
                                    <i class="icon-file-excel" style="font-size: 2rem; color: green"></i>
                                @endif
                            </td>

                            <td style="font-size: 1rem; width: 200px">
                                <p>{{ basename($file) }}</p>
                            </td>


                            <td style="font-size: 1rem; width: 150px">
                                <a class="btn btn-info" href="{{ route('books.edit', $id) }}?filename={{ basename($file) }}" style=""><i class="icon-eye"></i> Trình chiếu</a>

                                @if(!in_array($extension, ['doc','docx','pdf','ppt','xls','xlsx']))
                                    <a class="btn btn-primary" href="#" style=""><i class="icon-download"></i> Tải xuống</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{--Dorm List Ends--}}

@endsection
