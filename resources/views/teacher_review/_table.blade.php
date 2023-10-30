<div class="row m-2">
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="name" class="form-control-label">Teacher Name *</label>
            <input class="form-control name" id="name"
                name="name" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Teacher Name">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="course_id" class="form-control-label">Course *</label>
            <select name="course_id" id="course_id" class="form-control course_id">
                <option value="" selected disabled>Select course</option>
            </select>
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="comment" class="form-control-label">Your comment *</label>
            <textarea class="form-control comment" id="comment"
                name="comment" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Your Comment"></textarea>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="name" class="form-control-label">Reviews *</label>
            <br>
            <div class="rating">
                <i class="fa fa-star" data-rating="1"></i>
                <i class="fa fa-star" data-rating="2"></i>
                <i class="fa fa-star" data-rating="3"></i>
                <i class="fa fa-star" data-rating="4"></i>
                <i class="fa fa-star" data-rating="5"></i>
            </div>
            <input type="hidden" name="review" id="rating" value="0">
        </div>
    </div>
    <hr>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>