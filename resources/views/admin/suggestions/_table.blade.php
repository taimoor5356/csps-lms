<div class="row m-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="name" class="form-control-label">Suggestions *</label>
            <textarea class="form-control name" id="name"
                name="name" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Suggestions"></textarea>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="name" class="form-control-label">Administrative Complains *</label>
            <textarea class="form-control name" id="name"
                name="name" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Administrative Complains "></textarea>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="name" class="form-control-label">General Complains *</label>
            <textarea class="form-control name" id="name"
                name="name" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Your Comments"></textarea>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="name" class="form-control-label">Review Administration *</label>
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