<link href="{{asset("plugins/fullcalendar/fullcalendar.min.css")}}" rel="stylesheet">
<link href="{{asset("plugins/fullcalendar/nifty-skin/fullcalendar-nifty.min.css")}}" rel="stylesheet">
<style>
    .fc-time{display : none;}
    td.break{width: 10px; height: 10px;}
</style>

<div class="panel panel-bordered panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">{{'Jadwal Kerja Bulan '.switch_month($month).' - '.$year}} </h3>
    </div>
    <div class="panel-body" style="padding-top: 20px">
        <div id='calendar'></div><br>
        <table><tr>
            @foreach ($data_shift as $item)
                <td style="width: 20px;height:20px;background-color:{{$item->calendar_color}}"></td><td class="break"></td><td>: {{$item->name}}</td><td class="break">
            @endforeach
        <tr></table>
        @if ($data->isEmpty())
            <div class="text-right">
                <a href="{{url('/admin/schedule/add')}}" class="btn btn-warning">Klik disini untuk menambahkan jadwal kerja!</a>
            </div>
        @endif
    </div>
</div>

<script src="{{asset("plugins/fullcalendar/lib/moment.min.js")}}"></script>
<script src="{{asset("plugins/fullcalendar/lib/jquery-ui.custom.min.js")}}"></script>
<script src="{{asset("plugins/fullcalendar/fullcalendar.min.js")}}"></script>
<script src="{{asset("plugins/fullcalendar/lang/id.js")}}"></script>
<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            fixedWeekCount: false,
            header:{
                left: 'prev,next',
                center: 'title',
                right: 'month,basicWeek'
            },
            defaultDate: '<?= $year ?>-<?= $month ?>-01',
            eventLimit: true, // allow "more" link when too many events
            events: [
                <?php foreach ($data as $item) { 
                    for ($i=1; $i <= $day; $i++) { ?>
                        <?php 
                            $shift = 'shift_'.$i;
                            foreach($data_shift as $shifts){
                                if($item->$shift == $shifts->name) {
                                    $color = $shifts->calendar_color;
                                    break;
                                }
                            }
                        ?>
                        {
                            title: '<?= $item->user_name ?>',
                            start: "<?= $year ?>-<?= $month ?>-<?= $i / 10 < 1 ? '0'. $i : $i ?>",
                            color: '<?= $color ?>'
                        },
                    <?php } ?>
                <?php } ?>
            ]
        });
    })
</script>