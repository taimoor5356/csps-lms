<div class="table-responsive p-3">
    <table class="data-table table align-items-center mb-0 table-bordered">
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
            @foreach ($groupedRevisionClasses as $class)
                <tr>
                    <td>{{\Carbon\Carbon::parse($class->day)->format('l, d M')}}</td>
                    @php 
                        $data = \App\Models\RevisionClass::where('day', $class->day)->get();
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
