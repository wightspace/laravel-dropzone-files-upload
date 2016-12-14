@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>ระบบอัพโหลดไฟล์เอกสาร</h1>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">อัพโหลดไฟล์</div>
                    <div class="panel-body">
                        <div class="alert alert-info"><strong>ข้อแนะนำ:</strong> ท่านสามารถลากไฟล์ที่ต้องการอัพโหลดมาวาง "Drop file here to upload"เพื่อทำการอัพโหลดได้</div>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="/upload" id="dropzone" method="post" class="dropzone" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="fallback">
                                <input name="file[]" type="file" multiple/>
                            </div>
                        </form>
                        <hr>
                        <h4><span id="showNumber">0</span> ไฟล์ถูกอัพโหลด</h4>
                        <div id="addFile" style="margin-bottom: 5px">

                        </div>
                        <form action="/send-info" method="post">
                            {{ csrf_field() }}
                            <div id="addForm"></div>
                            <div class="form-group">
                                <label for="inputFullname">กรอกชื่อ :</label>
                                <input type="text" class="form-control" id="inputFullname" name="fullname" placeholder="กรอกชื่อ" required>
                            </div>
                            <div class="form-group">
                                <label for="inputDepartment">หน่วยงาน :</label>
                                <input type="text" class="form-control" id="inputDepartment" name="department" placeholder="กรอกชื่อหน่วยงาน" required>
                            </div>
                            <div class="form-group">
                                <label for="inputPhone">เบอร์โทร :</label>
                                <input type="text" class="form-control" id="inputPhone" name="phone" placeholder="กรอกเบอร์โทรศัพท์ที่ติดต่อได้" required>
                            </div>
                            <button type="submit" class="btn btn-primary" disabled="disabled">บันทึกข้อมูล</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        Dropzone.autoDiscover = false;
        var i = 0;
        $(function () {
            $('#inputName').focus();
            var myDropzone = new Dropzone('#dropzone');
            myDropzone.on('success', function (file, response) {
                console.log(response);
                i++;
                $('#showNumber').html(i);
                var txt = '<div style="border-bottom: 1px dashed crimson" id="f__' + response[1][0].id + '">' + response[1][0].filename + ' <span class="pull-right"><a href="javascript:confirm(\'คุณแน่ใจหรือที่จะลบไฟล์นี้ออก?\') ? removeFile(' + response[1][0].id + ') : console.log(\'file not remove\')" class="text-danger"><i class="fa fa-times"></i></a></span>' + '</div>';
                $('#addFile').append(txt);
                var forFrom = '<input type="hidden" name="file_id[]" id="i__' + response[1][0].id + '" value="' + response[1][0].id + '">';
                $('#addForm').append(forFrom);
                $('button.btn-primary').removeAttr('disabled');
            });
        });

        var removeFile = function (id) {
            console.log('removing file: ' + id);
            axios.post('/remove-file', {
                id: id
            }).then(function (response) {
                i--;
                var id = response.data;
                $('#f__' + id).remove();
                $('#i__' + id).remove();
                $('#showNumber').html(i);
                i < 1 ? $('button.btn-primary').attr('disabled', 'disabled') : $('button.btn-primary').removeAttr('disabled');
            });
        }
    </script>
@endsection
