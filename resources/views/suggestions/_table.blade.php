<div class="row m-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="suggestions" class="form-control-label">Suggestions *</label>
            <textarea class="form-control suggestions" id="suggestions"
                name="suggestions" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Suggestions"></textarea>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="administrative_complaints" class="form-control-label">Administrative Complains *</label>
            <textarea class="form-control administrative_complaints" id="administrative_complaints"
                name="administrative_complaints" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Administrative Complains "></textarea>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="general_complaints" class="form-control-label">General Complains *</label>
            <textarea class="form-control general_complaints" id="general_complaints"
                name="general_complaints" type="text"
                value="@isset($student->user) {{ $student->user->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Your Comments"></textarea>
        </div>
    </div>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <label for="administration_review" class="form-control-label">Review Administration *</label>
            <br>
            <div class="rating">
                <i class="fa fa-star" data-rating="1"></i>
                <i class="fa fa-star" data-rating="2"></i>
                <i class="fa fa-star" data-rating="3"></i>
                <i class="fa fa-star" data-rating="4"></i>
                <i class="fa fa-star" data-rating="5"></i>
            </div>
            <input type="hidden" name="administration_review" id="rating" value="0">
        </div>
    </div>
    <hr>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group mb-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>