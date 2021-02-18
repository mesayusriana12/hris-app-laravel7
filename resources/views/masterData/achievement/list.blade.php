@extends('layouts/templateAdmin')
@section('title','Sistem / Leader Board Karyawan HRIS')
@section('content-title','LeaderBoard Karyawan')
@section('content-subtitle','HRIS PT. Cerebrum Edukanesia Nusantara')
@section('head')
<link href="{{asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet">
    
@endsection
@section('content')

<div class="panel panel-bordered panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">LeaderBoard Achievement</h3>
    </div>
    <div class="panel-body">
        <form action="/admin/achievement/search" method="post" id="cari-achievement">
            @csrf
            {{-- <label class="col-sm-1 control-label">Bulan:</label> --}}
            <div id="datepicker-input-cari">
                <div class="col-sm-6">
                    <div class="input-group">
                        <span class="input-group-addon">Bulan :</span>
                        
                        <select class="selectpicker" data-style="btn-info" 
                        style="width: 100%" 
                        id="filter-bulan"  name="month">
                            <option value=" "></option>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="juli">juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                        <span class="input-group-addon">Tahun :</span>
                        <input type="text" class="form-control @error('year') is-invalid @enderror"
                            placeholder="Tahun" name="year" value="{{old('year')}}"  autocomplete="off">
                    </div>
                    {{-- @error('start') <div class="text-danger invalid-feedback mt-3">Mohon isi
                        tanggal mulai.</div> @enderror
                    @error('end') <div class="text-danger invalid-feedback mt-3">Mohon isi
                    tanggal akhir.</div> @enderror --}}
                </div>
            </div>
    </div>
    <div class="panel-footer text-right">
        {{-- <a href="/staff/presence/test" class="btn btn-warning float-right">Toogle presensi</a> --}}
        <button type="submit" class="btn btn-success float-right" >Cari Achievement</button>
    </div>
    </form>
</div>

<div id="panel-output">

</div>
@endsection









{{-- <div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title text-center text-bold">Leaderboard Karyawan</h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-12">
                @if (session('status'))
                <div class="alert alert-info alert-dismissable">
                    <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                    {{session('status')}}
                </div>
                @endif
                <div class="row">
                    <div class="col-sm-2">
                        <a href="#" class="btn btn-primary btn-labeled"
                            style="margin-bottom:15px">
                            <i class="btn-label fa fa-plus"></i>
                            Tambah Data
                        </a>
                    </div>
                    <div class="col-sm-7"></div>
                    <div class="col-sm-3">
                        <div class="form-group float-right">
                            <form action="/admin/achievement/search" method="post">
                            <select class="selectpicker" data-style="btn-danger" 
                            style="width: 100%" 
                            id="filter-bulan" onchange="filter_division()" name="month">
                                <option value=""></option>
                                <option value="Januari">Januari</option>
                                <option value="Februari">Februari</option>
                                <option value="Maret">Maret</option>
                                <option value="April">April</option>
                                <option value="Mei">Mei</option>
                                <option value="Juni">Juni</option>
                                <option value="juli">juli</option>
                                <option value="Agustus">Agustus</option>
                                <option value="September">September</option>
                                <option value="Oktober">Oktober</option>
                                <option value="November">November</option>
                                <option value="Desember">Desember</option>
                            </select>
                            <div class="form-control">
                                <input type="text" name="year" id="">
                            </div>
                            <button type="submit" class="btn btn-danger">Search</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@section('script')
<script src="{{asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>
<script>
    // function filter_division(){
    //     var input, filter, table, tr, td, i, txtValue;
    //     input = document.getElementById("filter-bulan");
    //     var valueopt = input.options[input.selectedIndex].value;
    //     var string = input.options[input.selectedIndex].text;
    //     filter = input.value.toUpperCase();
    //     console.log(filter)
    //     table = document.getElementById("masterdata-achievement");
    //     tr = table.getElementsByTagName("tr");
    //     for (i = 0; i < tr.length; i++) {
            
    //             td = tr[i].getElementsByTagName("td")[3];
    //             if (td) {
    //                 txtValue = td.textContent || td.innerText;
    //                 if (txtValue.toUpperCase().indexOf(filter) > -1) {
    //                     tr[i].style.display = "";
    //                 } else {
    //                     tr[i].style.display = "none";
    //                 }
    //             }
            
    //     }
    
    // }
        // input = document.getElementById("filter-bulan");
        // var valueopt = input.options[input.selectedIndex].value;
        // var string = input.options[input.selectedIndex].text;
        // console.log(valueopt);
        // console.log(string);
        
    $(document).ready(function () {
        $('#cari-achievement').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                // data: {  _token : <?php Session::token() ?>},
                data: $(this).serialize(),
                success: function (data) {
                    $("#panel-output").html(data);
                },
                error: function (jXHR, textStatus, errorThrown) {
                    alert(errorThrown);
                }
            });
        });
    });
</script>
@endsection