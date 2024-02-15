<div class="table-responsive p-3">
    <table class="data-table table cell-border align-items-center mb-0 table-bordered">
        <thead>
            <tr>
                {{-- <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Show/Hide
                </th> --}}
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Days
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                    Subject Name / Time
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                    Subject Name / Time
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groupedMockSchedule as $schedule)
                <tr>
                    <td>{{\Carbon\Carbon::parse($schedule->day)->format('l, d M')}}</td>
                    @php 
                        $data = \App\Models\MockSchedule::where('day', $schedule->day)->get();
                    @endphp
                    @foreach ($data as $d)
                        <td><span class="bg-primary rounded p-1 text-white">{{$d->course->name}} / {{$d->time}}</span></td>
                    @endforeach
                </tr>
                <tr></tr>
            @endforeach
        </tbody>
    </table>
</div>
