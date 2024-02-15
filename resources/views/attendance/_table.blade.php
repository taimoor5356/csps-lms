<div class="table-responsive p-3">
    <table class="data-table table cell-border align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Name
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Registration Number
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                    Batch Number
                </th>
                @if (Auth::user()->hasRole('admin'))
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                    Course
                </th>
                @endif
                @if (Auth::user()->hasRole('admin|teacher'))
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Attendance
                </th>
                @endif
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
