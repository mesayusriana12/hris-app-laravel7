@extends('layouts/templateStaff')
@section('title','Jadwal Kerja')
@section('content-title','Jadwal Kerja Divisi / Daftar Jadwal Kerja Divisi')
@section('content-subtitle','HRIS PT. Cerebrum Edukanesia Nusantara')

@section('head')
    <link href="{{asset("plugins/bootstrap-datepicker/bootstrap-datepicker.min.css")}}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        tbody {
            color: black;
        }

    </style>
@endsection

@section('content')
    <div class="panel panel-bordered panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Daftar Jadwal Kerja Divisi</h3>
        </div>
        
        <form action="{{url('/staff/schedule/search')}}" method="POST" id="schedule-search">
            @csrf
        </form>

        <div class="panel-body">
            <div class="row mar-btm">
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                    <div id="pickadate">
                        <div class="input-group date">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" style="z-index: 2">
                                    <i class="fa fa-calendar"></i>
                                </button>
                            </span>
                            <input type="text" name="query" placeholder="Masukan Tanggal untuk mencari Jadwal"
                                class="form-control" autocomplete="off" id="query" form="schedule-search" readonly>
                            <span class="input-group-btn">
                                <button class="btn btn-primary" id="btn-search" type="submit" form="schedule-search"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="panel-output"></div>
@endsection


@section('script')
    <script src="{{asset("plugins/bootstrap-datepicker/bootstrap-datepicker.min.js")}}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#pickadate .input-group.date').datepicker({
                format: 'mm/yyyy',
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
            $('#schedule-search').on('submit', function (event) {
                event.preventDefault();
                var periode = document.getElementById('query').value;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: {periode: periode},
                    success: function (data) {
                        $("#panel-output").html(data);
                    },
                    error: function (jXHR, textStatus, errorThrown) {
                        Swal.fire({
                            title: errorThrown,
                            text: "Form belum diisi dengan benar / Tidak ada data jadwal untuk bulan terpilih",
                            icon: 'error',
                            width: 600
                        });
                    }
                });
            });
        });
    </script>
@endsection
