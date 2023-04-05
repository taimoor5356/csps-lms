<div class="table-responsive p-3">
    <table class="data-table table table-bordered align-items-center mb-0">
        <thead>
            <tr>
                {{-- <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Show/Hide
                </th> --}}
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                </th>
            </tr>
        </thead>
        <tbody>
            @php $data = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];  @endphp
            @foreach ($data as $d)
                <tr>
                    <td>{{ $d }}</td>
                    <td>Lecture Name (05:30pm)</td>
                    <td>Lecture Name (05:30pm)</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
