@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">แสดงไฟล์</div>
                    <div class="panel-body">
                        <h3>กำลังแสดงไฟล์จากผู้ส่ง {{$document->fullname}}</h3>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ชื่อไฟล์</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($files->count() < 1)
                            <tr>
                                <td colspan="3" class="text-center"> == no data ==</td>
                            </tr>
                        @endif
                        @php ($i = 1)
                        @foreach($files as $file)
                            <tr>
                                <td>{{$i}}</td>
                                <td><a target="_blank" href="/open-file-{{$file->id}}" >{{$file->original_name}}</a></td>
                                <td class="text-right">
                                    <a target="_blank" href="/open-file-{{$file->id}}" class="btn btn-xs btn-primary"><i class="fa fa-search"></i> เปิดดู</a>
                                    <a href="/download-file-{{$file->id}}" class="btn btn-xs btn-default"><i class="fa fa-download"></i> ดาวน์โหลด</a>
                                    <a href="/delete-file-{{$file->id}}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> ลบไฟล์</a>
                                </td>
                            </tr>
                            @php($i++)
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
