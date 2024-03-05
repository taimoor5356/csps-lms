<div class="table-responsive p-3">
    <table class="data-table table cell-border align-items-center mb-0">
        <thead>
            <tr>
                @if (!empty($userId))
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Date/Time
                </th>
                @endif
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Name
                </th>
                @if ($userType == 'students')
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Registration Number
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                    Batch Number
                </th>
                @endif
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                    Course
                </th>
                @can ('attendance_create')
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Attendance
                </th>
                @endcan
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
