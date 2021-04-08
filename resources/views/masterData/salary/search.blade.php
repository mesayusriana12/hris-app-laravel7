@extends('layouts/templateAdmin')
@section('title','Data Staff')
@section('content-title','Data Staff / Gaji')
@section('content-subtitle','HRIS PT. Cerebrum Edukanesia Nusantara')
@section('head')
<link href="{{asset("plugins/bootstrap-datepicker/bootstrap-datepicker.min.css")}}" rel="stylesheet">
<link href="{{ asset('css/sweetalert2.min.css')}}" rel="stylesheet">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<div class="panel panel-bordered panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">Daftar Gaji</h3>
    </div>
    <div class="panel-body">
        <div class="row mar-btm" >
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form action="{{url('/admin/salary')}}" method="POST" id="search-salary">
                    @csrf
                    <div id="pickadate">
                        <div class="input-group date">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" style="z-index: 2"><i class="fa fa-calendar"></i></button>
                            </span>
                            <input type="text" name="periode" placeholder="Cari Data Gaji" id="periode"
                                class="form-control" autocomplete="off" readonly>
                            <span class="input-group-btn">
                                <button class="btn btn-danger" id="btn-search" type="submit"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
</div>

<div id="panel-output">

</div>
@endsection


@section('script')
<script src="{{asset("plugins/bootstrap-datepicker/bootstrap-datepicker.min.js")}}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
<script>
        
    $(document).ready(function () {
        $('#pickadate .input-group.date').datepicker({
            format: 'yyyy-mm',
            autoclose: true,
            minViewMode: 'months',
            maxViewMode: 'years',
            startView: 'months',
            orientation: 'bottom',
            forceParse: false,
        });
        $('#btn-search').on('click',function () {
            $('.datepicker').hide();
        });
        $('#search-overtime').on('submit', function (event) {
            event.preventDefault();
            var periode = document.getElementById('periode').value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }});
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: {periode: periode},
                success: function (data) {
                    $("#panel-output").html(data);
                },
                error: function (jXHR, textStatus, errorThrown) {
                    Swal.fire({
                        title: 'Error!',
                        text: "Isi form terlebih dahulu!",
                        icon: 'error',
                        width: 600
                    });
                }
            });
        });
    });
</script>
@endsection