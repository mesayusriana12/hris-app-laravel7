@extends('layouts/templateAdmin')
@section('content-title','Data Staff / Data / Edit Data Staff')
@section('content-subtitle','HRIS PT. Cerebrum Edukanesia Nusantara')
@section('title','Data Staff')
@section('content')
@section('head')
<!--Bootstrap Timepicker [ OPTIONAL ]-->
<link href="{{asset("plugins/bootstrap-datepicker/bootstrap-datepicker.min.css")}}" rel="stylesheet">
<!--Bootstrap Select [ OPTIONAL ]-->
<link href="{{asset("plugins/bootstrap-select/bootstrap-select.min.css")}}" rel="stylesheet">
@endsection
<div class="panel panel-danger panel-bordered">
    <div class="panel-heading">
        <h3 class="panel-title">Form Edit Data Staff</h3>
    </div>
    <form class="form-horizontal" action="/admin/data-staff/{{$staff->id}}" method="POST">
        <div class="panel-body">
            @csrf
            @method('put')
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label">NIP:</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="NIP" name="nip"
                            class="form-control @error('nip') is-invalid @enderror" value="{{$staff->nip}}">
                        @error('nip') <div class="text-danger invalid-feedback mt-3">
                            Mohon isi NIP.
                        </div> @enderror
                    </div>
                    <label class="col-sm-2 control-label">Nama Staff:</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Nama Lengkap" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{$staff->name}}">
                        @error('name') <div class="text-danger invalid-feedback mt-3">
                            Mohon isi nama lengkap.
                        </div> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label">Tanggal Lahir:</label>
                    <div id="datepicker-edit-dob">
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <input type="text" class="form-control @error('dob') is-invalid @enderror"
                                    placeholder="Tanggal Lahir" name="dob" value="{{$staff->dob}}">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                            @error('dob') <div class="text-danger invalid-feedback mt-3">Mohon isi
                                tanggal lahir.</div> @enderror
                        </div>
                    </div>
                    <label class="col-sm-2 control-label">Jenis Kelamin:</label>
                    <div class="col-sm-4">
                        <div class="radio">
                            <!-- Inline radio buttons -->
                            <input id="gender-1" class="magic-radio" type="radio" name="gender" value="Laki-laki"
                                {{$staff->gender == 'Laki-laki' ? 'checked' : ''}}>
                            <label for="gender-1">Laki-laki</label>
                            <input id="gender-2" class="magic-radio" type="radio" name="gender" value="Perempuan"
                                {{$staff->gender == 'Perempuan' ? 'checked' : ''}}>
                            <label for="gender-2">Perempuan</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label" for="textarea-input-live_at">Alamat:</label>
                    <div class="col-sm-10">
                        <textarea id="textarea-input-live_at" rows="2" class="form-control"
                            placeholder="Alamat Lengkap" name="live_at">{{$staff->live_at}}</textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label">No Handphone:</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Nomor Handphone" name="phone_number"
                            class="form-control @error('phone_number') is-invalid @enderror"
                            value="{{$staff->phone_number}}">
                        @error('phone_number') <div class="text-danger invalid-feedback mt-3">
                            {{$message}}
                        </div> @enderror
                    </div>
                    <label class="col-sm-2 control-label">Email:</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Alamat Email" name="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{$staff->email}}">
                        @error('email') <div class="text-danger invalid-feedback mt-3">
                            {{$message}}
                        </div> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label">Status Karyawan:</label>
                    <div class="col-sm-4">
                        <div class="radio">
                            <!-- Inline radio buttons -->
                            <input id="employee_status_radio-1" class="magic-radio" type="radio"
                                name="employee_status" value="Tetap" onclick="showContractOption()"
                                {{$staff->employee_status == 'Tetap' ? 'checked' : ''}}>
                            <label for="employee_status_radio-1">Tetap</label>
                            <input id="employee_status_radio-2" class="magic-radio" type="radio"
                                name="employee_status" value="Kontrak" onclick="showContractOption()"
                                {{$staff->employee_status == 'Kontrak' ? 'checked' : ''}}>
                            <label for="employee_status_radio-2">Kontrak</label>
                        </div>
                    </div>
                    <span id="input-contract_duration">
                        <label class="col-sm-2 control-label">Durasi Kontrak:</label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="Lama kontrak dalam satuan bulan"
                                name="contract_duration"
                                class="form-control @error('contract_duration') is-invalid @enderror"
                                value="{{$staff->contract_duration}}">
                            @error('contract_duration') <div class="text-danger invalid-feedback mt-3">
                                Mohon hanya isi durasi kontrak dengan angka daalam hitungan perbulan.
                            </div> @enderror
                            <small class="text-muted">Tidak perlu diisi jika staff berstatus
                                tetap.</small>
                        </div>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tipe Karyawan:</label>
                <div class="col-sm-10">
                    <div class="radio">
                        <!-- Inline radio buttons -->
                        <input id="employee_type_radio-1" class="magic-radio" type="radio" name="employee_type"
                            value="Fulltime" {{$staff->employee_type == 'Fulltime' ? 'checked' : ''}}>
                        <label for="employee_type_radio-1">Fulltime</label>
                        <input id="employee_type_radio-2" class="magic-radio" type="radio" name="employee_type"
                            value="Freelance" {{$staff->employee_type == 'Freelance' ? 'checked' : ''}}>
                        <label for="employee_type_radio-2">Freelance</label>
                        <input id="employee_type_radio-3" class="magic-radio" type="radio" name="employee_type"
                            value="Magang" {{$staff->employee_type == 'Magang' ? 'checked' : ''}}>
                        <label for="employee_type_radio-3">Magang</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Status:</label>
                <div class="col-sm-10">
                    <div class="radio">
                        <!-- Inline radio buttons -->
                        <input id="status_radio-1" class="magic-radio" type="radio" name="status" value="Aktif"
                            {{$staff->status == 'Aktif' ? 'checked' : ''}}>
                        <label for="status_radio-1">Aktif</label>
                        <input id="status_radio-2" class="magic-radio" type="radio" name="status" value="Non-Aktif"
                            {{$staff->status == 'Non-Aktif' ? 'checked' : ''}}>
                        <label for="status_radio-2">Non-Aktif</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label">Tanggal Mulai Bekerja:</label>
                    <div id="datepicker-edit-mulai-kerja">
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <input type="text"
                                    class="form-control @error('start_work_date') is-invalid @enderror"
                                    placeholder="Tanggal Mulai Bekerja" name="start_work_date"
                                    value="{{$staff->start_work_date}}">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                            @error('start_work_date') <div class="text-danger invalid-feedback mt-3">
                                Mohon isi tanggal mulai bekerja.</div> @enderror
                        </div>
                    </div>
                    <label class="col-sm-2 control-label">Tanggal Akhir Bekerja:</label>
                    <div id="datepicker-edit-selesai-kerja">
                        <div class="col-sm-4">
                            <div class="input-group date">
                                <input type="text" class="form-control @error('end_work_date') is-invalid @enderror"
                                    placeholder="Tanggal Akhir Bekerja" name="end_work_date"
                                    value="{{$staff->end_work_date}}">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                            @error('end_work_date') <div class="text-danger invalid-feedback mt-3">
                                {{$message}}</div> @enderror
                            <small class="text-muted">Tidak perlu diisi jika staff masih
                                bekerja.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label" for="division_id">Divisi:</label>
                    <div class="col-sm-4">
                        <select class="selectpicker" data-style="btn-info" name="division_id">
                            @foreach ($divisions as $item)
                            <option value="{{$item->divisions_id}}"
                                {{$staff->division_id == $item->divisions_id ? 'selected' : ''}}>
                                {{$item->divisions_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <label class="col-sm-2 control-label" for="division_id">Jabatan:</label>
                    <div class="col-sm-4">
                        <select class="selectpicker" data-style="btn-success" name="position_id">
                            @foreach ($positions as $item)
                            <option value="{{$item->positions_id}}"
                                {{ $staff->position_id == $item->positions_id ? 'selected' : ''}}>
                                {{$item->positions_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label" for="division_id">Hak akses:</label>
                    <div class="col-sm-4">
                        <select class="selectpicker" data-style="btn-purple" name="role_id">
                            @foreach ($roles as $item)
                            <option value="{{$item->roles_id}}"
                                {{ $staff->role_id == $item->roles_id ? 'selected' : '' }}>
                                {{$item->roles_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Sisa Cuti Tahunan:</label>
                <div class="col-sm-4">
                    <input type="text" placeholder="Sisa cuti diisi hanya dengan angka"
                        name="yearly_leave_remaining"
                        class="form-control @error('yearly_leave_remaining') is-invalid @enderror"
                        value="{{$staff->yearly_leave_remaining}}">
                    @error('yearly_leave_remaining') <div class="text-danger invalid-feedback mt-3">
                        Mohon isi sisa cuti hanya dengan angka.
                    </div> @enderror
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-2 control-label" for="credit_card_bank">Bank:</label>
                    <div class="col-sm-4">
                        <select class="selectpicker" data-style="btn-mint" name="credit_card_bank">
                            <option value="BNI" {{$staff->credit_card_bank == 'BNI' ? 'selected' : ''}}>BNI</option>
                            <option value="BCA" {{$staff->credit_card_bank == 'BCA' ? 'selected' : ''}}>BCA</option>
                            <option value="BRI" {{$staff->credit_card_bank == 'BRI' ? 'selected' : ''}}>BRI</option>
                            <option value="BJB" {{$staff->credit_card_bank == 'BJB' ? 'selected' : ''}}>BJB</option>
                            <option value="Mandiri" {{$staff->credit_card_bank == 'Mandiri' ? 'selected' : ''}}>Mandiri</option>
                            @error('credit_card_bank') <div class="text-danger invalid-feedback mt-3">
                                Mohon pilih bank.
                            </div> @enderror
                        </select>
                    </div>
                    <label class="col-sm-2 control-label" for="credit_card_number">No. Rekening:</label>
                    <div class="col-sm-4">
                        <input type="text" placeholder="Nomor Rekening tanpa Kode Bank"
                        name="credit_card_number"
                        class="form-control @error('credit_card_number') is-invalid @enderror"
                        value="{{$staff->credit_card_number}}">
                        @error('credit_card_number') <div class="text-danger invalid-feedback mt-3">
                            Mohon isi sisa cuti hanya dengan angka.
                        </div> @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="salary">Gaji Pokok:</label>
                <div class="col-sm-4">
                    <input type="text" placeholder="Gaji Pokok" name="salary" id="salary"
                        class="form-control @error('salary') is-invalid @enderror"
                        value="{{$staff->salary}}" onkeyup="format_rp()">
                    @error('salary') <div class="text-danger invalid-feedback mt-3">
                        Mohon isi gaji pokok.
                    </div> @enderror
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn btn-mint" type="submit">Simpan</button>
        </div>
    </form>
</div>
@section('script')
<!--Bootstrap Timepicker [ OPTIONAL ]-->
<script src="{{asset("plugins/bootstrap-datepicker/bootstrap-datepicker.min.js")}}"></script>
<!--Bootstrap Select [ OPTIONAL ]-->
<script src="{{asset("plugins/bootstrap-select/bootstrap-select.min.js")}}"></script>

<script>
    function showContractOption() {
        if (document.getElementById('employee_status_radio-1').checked) {
            document.getElementById('input-contract_duration').style.display = 'none';
        } else {
            document.getElementById('input-contract_duration').style.display = 'block';
        }
    };

    function format_rp() {
        var angka = document.getElementById("salary").value;
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        document.getElementById("salary").value = 'Rp. ' + rupiah;
    }

    $(document).ready(function () {
        $('#datepicker-edit-dob .input-group.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true,
            orientation: 'bottom',
            endDate: '0d'
        });
        $('#datepicker-edit-mulai-kerja .input-group.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true,
            orientation: 'bottom',
            todayBtn: true
        });
        $('#datepicker-edit-selesai-kerja .input-group.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true,
            orientation: 'bottom',
        });
    });

</script>
@endsection
@endsection
