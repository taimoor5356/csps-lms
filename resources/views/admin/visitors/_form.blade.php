<div class="row">
    <div class="col-6">
        <div class="text-danger text-sm">Mandatory(*)</div>
    </div>
    <div class="col-6">
        <div class="alert-messages w-50 ms-auto text-center">
            <div class="toast bg-success" id="notification" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header text-bold text-white py-0 bg-success border-bottom border-white">
                    <span class="success-header"></span>
                    <div class="close-toast-msg ms-auto text-end cursor-pointer">
                        X
                    </div>
                </div>
                <div class="toast-body text-white text-bold">

                </div>
            </div>
        </div>
    </div>
</div>
<hr class="horizontal dark">
{{-- <p class="text-uppercase text-sm">visitor Profile</p> --}}
<div class="row">
    <div class="admin-form row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <input type="radio" name="class_type" value="campus" id="on-campus">
                <label for="class-type" class="form-control-label">On Campus *</label>
                <p><small class="text-success">notification for upcoming on campus seminar shown here</small></p>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <input type="radio" name="class_type" value="online" id="on-line">
                <label for="class-type" class="form-control-label">Online *</label>
                <p><small class="text-success">notification for upcoming online seminar shown here</small></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="name" class="form-control-label">Name *</label>
                <input class="form-control name" id="name"
                    name="name" type="text" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="visitor Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="gender" class="form-control-label">Gender *</label>
                <select class="form-control gender" name="gender"
                    id="gender">
                    <option value="" disabled selected>Select Gender</option>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="cell_no" class="form-control-label">Contact No *</label>
                <input class="form-control cell_no" id="cell_no"
                    name="cell_no" type="number"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Contact No">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="email" class="form-control-label">Email *</label>
                <input class="form-control email" id="email"
                    name="email" type="email"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Email Address">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="degree" class="form-control-label">Qualification *</label>
                <input class="form-control degree" id="degree"
                    name="degree" type="text"
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Degree Name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="domicile" class="form-control-label">Domicile *</label>
                <select class="form-control domicile"
                    name="domicile" id="domicile">
                    <option value="" disabled selected>Select Domicile</option>
                    <option value="punjab">Punjab</option>
                    <option value="kpk">KPK</option>
                    <option value="sindh">Sindh</option>
                    <option value="baloch">Baloch</option>
                    <option value="ict">ICT</option>
                    <option value="ajk">AJK</option>
                    <option value="gb">GB</option>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="applied_for" class="form-control-label">Program *</label>
                <select class="form-control applied_for"
                    name="applied_for" id="applied_for">
                    <option value="" disabled selected>Applying For</option>
                    <option value="css">CSS</option>
                    <option value="pms">PMS</option>
                    <option value="interview">Interview</option>
                    <option value="others">Others</option>
                </select>
            </div>
        </div>
    </div>
</div>
<hr class="horizontal dark">
