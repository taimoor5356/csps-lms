<div class="table-responsive p-3">
    <table class="data-table table cell-border align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Image
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                    Student Name
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                    Teacher Name
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                    Course Name
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder ps-2">
                    Category
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Fee
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Marks
                </th>
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Completion Date
                </th>
                @can('enrollment_update')
                <th class="text-uppercase text-dark text-xs font-weight-bolder">
                    Actions
                </th>
                @endcan
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
