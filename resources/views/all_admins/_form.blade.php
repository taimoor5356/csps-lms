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
<p class="text-uppercase text-sm">Registration Details</p>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="batch_no" class="form-control-label">Batch No *</label>
            <input class="form-control batch_no" id="batch_no" name="batch_no" type="text" value="@isset($admin->user){{ $admin->batch_no }}@endisset" onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Batch No" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="reg_no" class="form-control-label">Registration No *</label>
            <input class="form-control reg_no" id="reg_no" name="reg_no" type="text" value="@isset($admin->user){{ $admin->reg_no }}@endisset" onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Registration No" >
        </div>
    </div>
</div>
<hr class="horizontal dark">
<p class="text-uppercase text-sm">Admin Profile</p>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="name" class="form-control-label">Name *</label>
            <input class="form-control name" id="name" name="name" type="text"
                value="@isset($admin->user){{ $admin->user->name }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Admin Name" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="email" class="form-control-label">Email *</label>
            <input class="form-control email" id="email" name="email" type="email"
                value="@isset($admin->user){{ $admin->user->email }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Email Address" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="password" class="form-control-label">Password *</label>
            <input class="form-control password" id="password" name="password" type="password"
                value="" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Password" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="father_name" class="form-control-label">Father Name *</label>
            <input class="form-control father_name" id="father_name" name="father_name" type="text"
                value="@isset($admin->user){{ $admin->father_name }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Admin's Father Name" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="dob" class="form-control-label">Date of Birth *</label>
            <input class="form-control dob" id="dob" name="dob" type="date"
                value="@isset($admin->user){{ $admin->dob }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Date of Birth" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="cnic" class="form-control-label">CNIC *</label>
            <input class="form-control cnic" id="cnic" name="cnic" step="0.01" type="number"
                value="@isset($admin->user){{ $admin->cnic }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter CNIC Number" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="domicile" class="form-control-label">Domicile *</label>
            <input class="form-control domicile" id="domicile" name="domicile" type="text"
                value="@isset($admin->user){{ $admin->domicile }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Domicile Name" >
        </div>
    </div>
    <div class="col-sm-4">
        <label for="photo" class="form-control-label">Profile Picture *</label>
        <input type="file" name="photo" onchange="document.getElementById('photo').src = window.URL.createObjectURL(this.files[0])" class="form-control">
        <div class="row img-preview">
            <div class="col-md-3 my-2">
                <img class="rounded" src="@isset($admin->user){{asset('public/assets/img/Admins/'.$admin->user->photo.'')}}@else{{asset('public/assets/img/user-profile.jpg')}}@endisset" alt="Product Image" id="photo" width="100" height="100">
            </div>
        </div>
    </div>
</div>
<hr class="horizontal dark">
<p class="text-uppercase text-sm">Address</p>
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="address" class="form-control-label">Address *</label>
            <input class="form-control address" id="address" name="address" type="text"
                value="@isset($admin->user){{ $admin->address }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Address" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="contact_res" class="form-control-label">Contact (Res) *</label>
            <input class="form-control contact_res" id="contact_res" name="contact_res" step="0.01" type="number"
                value="@isset($admin->user){{ $admin->contact_res }}@endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter Contact (Res)" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="cell_no" class="form-control-label">Cell *</label>
            <input class="form-control cell_no" id="cell_no" name="cell_no" step="0.01" type="number"
                value="@isset($admin->user){{ $admin->cell_no }}@endisset"
                onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter Cell No" >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="name" class="form-control-label">Role</label>
            <select class="form-control" name="role" id="role">
                <option value="" disabled selected>Select User Role Type</option>
                @foreach ($roles as $key => $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<hr class="horizontal dark">
