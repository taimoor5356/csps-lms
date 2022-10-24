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
            <label for="name" class="form-control-label">Subject *</label>
            <input class="form-control name" id="name"
                name="name" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Subject">
        </div>
    </div>
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="name" class="form-control-label">Your Comments *</label>
            <textarea class="form-control name" id="name"
                name="name" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Your Comments"></textarea>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="name" class="form-control-label">Reviews *</label>
            <br>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
    </div>
    <hr>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <button type="button" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>