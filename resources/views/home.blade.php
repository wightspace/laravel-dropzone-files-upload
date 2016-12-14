@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>


                    <table class="table">
                        <thead>
                        <tr>
                            <th>เมื่อ</th>
                            <th>ผู้ส่ง</th>
                            <th>หน่วยงาน</th>
                            <th>เบอร์โทร</th>
                            <th>จัดการ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($documents->count() < 1)
                            <tr>
                                <td colspan="5" class="text-center"> == No Data ==</td>
                            </tr>
                        @endif
                        @foreach($documents as $document)
                            <tr>

                                <td>{{ $document->created_at->diffForHumans()  }} </td>
                                <td>{{ $document->fullname }}</td>
                                <td>{{ $document->department }}</td>
                                <td>{{ $document->phone }}</td>
                                <td>
                                    <a href="/show-file-{{$document->id}}" class="btn btn-xs btn-info"><i class="fa fa-paperclip"></i> แสดงไฟล์</a>
                                    <a href="/delete-document-{{$document->id}}" class="btn btn-xs btn-danger"><i class="fa fa-times"></i> ลบ</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="panel-footer">
                        {{ $documents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
