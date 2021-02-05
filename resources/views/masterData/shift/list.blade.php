@extends('layouts/templateAdmin')
@section('content-title','Data Shift')
@section('content-subtitle','HRIS PT. Cerebrum Edukanesia Nusantara')
@section('title','Masterdata Waktu Shift')
@section('content')

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title text-center text-bold">List Waktu Shift</h3>
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
                        <a href="{{url('/admin/shift/add')}}" class="btn btn-primary btn-labeled"
                            style="margin-bottom:15px">
                            <i class="btn-label fa fa-plus"></i>
                            Tambah Waktu Shift
                        </a>
                    </div>
                    <div class="col-sm-7"></div>
                    <div class="col-sm-3 hidden">
                        <div class="form-group float-right">
                            <input type="text" name="cari-shift" id="cari-shift" class="form-control"
                                placeholder="Cari Shift" />
                        </div>
                    </div>
                </div>
                <table id="masterdata-shift"
                    class="table table-striped table-bordered dataTable no-footer dtr-inline collapsed" role="grid"
                    aria-describedby="demo-dt-basic_info" style="width: 100%;" width="100%" cellspacing="0">
                    <thead>
                        <tr role="row">
                            <th class="sorting_asc text-center" tabindex="0" aria-controls="demo-dt-basic" rowspan="1"
                                colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                                ID Shift</th>
                            <th class="sorting text-center" tabindex="0" aria-controls="demo-dt-basic" rowspan="1"
                                colspan="1" aria-label="Position: activate to sort column ascending">Nama Shift</th>
                            <th class="sorting text-center" tabindex="0" aria-controls="demo-dt-basic" rowspan="1"
                                colspan="1" aria-label="Jam masuk: activate to sort column ascending">Jam Masuk</th>
                            <th class="sorting text-center" tabindex="0" aria-controls="demo-dt-basic" rowspan="1"
                                colspan="1" aria-label="Jam Kerja: activate to sort column ascending">Jam Keluar</th>
                            <th class="sorting text-center" tabindex="0" aria-controls="demo-dt-basic" rowspan="1"
                                colspan="1" aria-label="Action">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shift as $row)
                        <tr>
                            <td tabindex="0" class="sorting_1 text-center">{{$row->id}}</td>
                            <td class="text-center">{{$row->name}}</td>
                            <td class="text-center">{{$row->start_working_time}}</td>
                            <td class="text-center">{{$row->end_working_time}}</td>
                            <td class="text-center">
                                <a href="/admin/shift/{{$row->id}}/edit"
                                    class="btn btn-success btn-icon btn-circle add-tooltip" data-toggle="tooltip"
                                    data-container="body" data-placement="top" data-original-title="Edit Waktu Shift"
                                    type="button">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <form action="/admin/shift/{{$row->id}}" method="POST"
                                    style="display: inline; margin: auto 5px">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-pink btn-icon btn-circle add-tooltip" data-toggle="tooltip"
                                        data-container="body" data-placement="top"
                                        data-original-title="Hapus Waktu Shift">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-2">
                        <ul class="pagination">
                            {{ $shift->links() }}
                        </ul>
                    </div>
                    <div class="col-sm-5"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
        $(document).ready(function(){

            fetch_data();

            function fetch_data(query =''){
                $.ajax({
                    url:"{{ route('data.division.search') }}",
method:'GET',
data:{query:query},
dataType:'json',
success:function(data)
{
('tbody').html(data.table_data);
}
})
}

$(document).on('keyup','#cari-divisi',function(){
var query = $(this).val();
fetch_data(query);
});
});
</script> --}}
@endsection
