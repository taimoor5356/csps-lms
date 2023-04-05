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
<p class="text-uppercase text-sm">Role</p>
<div class="row">
    <div class=" col-md-4">
        <div class="form-group">
            <label for="name" class="form-control-label">Role Name *</label>
            <input class="form-control name" id="name" name="name" type="text"
                value="@isset($role) {{ $role->name }} @endisset" onfocus="focused(this)"
                onfocusout="defocused(this)" placeholder="Enter role">
        </div>
    </div>
</div>
<hr class="horizontal dark">
