<script>
    $(document).ready(function() {
        $('.select2').select2();
        @if (session('success'))
            $('.toast .success-header').html('Success');
            $('.toast .toast-header').addClass('bg-success');
            $('.toast .toast-body').addClass('bg-success');
            $('.toast .toast-body').html("{{session('success')}}");
            $('.toast').toast('show');
        @elseif(session('error'))
            $('.toast .success-header').html('Error');
            $('.toast .toast-header').addClass('bg-danger');
            $('.toast .toast-body').addClass('bg-danger');
            $('.toast .toast-body').html("{{session('error')}}");
            $('.toast').toast('show');
        @endif
        $(document).on('click', '#add-education', function () {
            if ($('.new-education-row').length >= 4) {
                return false;
            } else {
                $('.education-information').append(`
                    <div class="row new-education-row border border-light m-1">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="degree" class="form-control-label">Degree *</label>
                                <input @if (Auth::user()->hasRole('student')) @endif class="form-control degree" id="degree"
                                    name="degree" type="text"
                                    value="@isset($student->user) {{ $student->degree }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Degree Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="major_subjects" class="form-control-label">Major Subjects *</label>
                                <input @if (Auth::user()->hasRole('student')) @endif class="form-control major_subjects"
                                    id="major_subjects" name="major_subjects" type="text"
                                    value="@isset($student->user) {{ $student->major_subjects }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Major Subject">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cgpa" class="form-control-label">CGPA/%age *</label>
                                <input @if (Auth::user()->hasRole('student')) @endif class="form-control cgpa" id="cgpa"
                                    name="cgpa" min="0.1" max="100.00" step="0.1" type="number"
                                    value="@isset($student->user) {{ $student->cgpa }} @endisset" onfocus="focused(this)"
                                    onfocusout="defocused(this)" placeholder="Enter CGPA/%age">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="board_university" class="form-control-label">Board/University *</label>
                                <input @if (Auth::user()->hasRole('student')) @endif class="form-control board_university"
                                    id="board_university" name="board_university" type="text"
                                    value="@isset($student->user) {{ $student->board_university }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Board/University">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="distinction" class="form-control-label">Profession *</label>
                                <input @if (Auth::user()->hasRole('student')) @endif class="form-control distinction"
                                    id="distinction" name="distinction" type="text"
                                    value="@isset($student->user) {{ $student->distinction }} @endisset"
                                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Profesion">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <label for="distinction" class="form-control-label">Remove</label>
                                <button type="button" class="btn btn-danger form-control remove-education-row">-</button>
                            </div>
                        </div>
                    </div>
            `);
            }
        });
        $(document).on('change', '#subject-type', function () {
            var _this = $(this);
            $('#all-subjects-view-list').addClass('d-none');
            $('#compulsory-subjects-view-list').addClass('d-none');
            if (_this.val() == 'all' || _this.val() == 'selected') {
                $('#all-subjects-view-list').removeClass('d-none');
            } else if (_this.val() == 'compulsory') {
                $('#compulsory-subjects-view-list').removeClass('d-none');
            }
        });
    });
    function alertMessage(message, removeclass, header, addclass) {
        $('.toast .toast-header').removeClass(removeclass);
        $('.toast .toast-header').removeClass(removeclass);
        $('.toast .toast-body').removeClass(removeclass);
        $('.toast .success-header').html(header);
        $('.toast .toast-header').addClass(addclass);
        $('.toast .toast-body').addClass(addclass);
        $('.toast .toast-body').html(message);
        $('.toast').toast('show');
    }
    function button(status, addclass, removeclass) {
        $('#save').prop('disabled', status);
        $('#save').removeClass(removeclass);
        $('#save').addClass(addclass);
    }
</script>