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
<p class="text-sm">Add New Expense</p>
<div class="row">
    @if (Auth::user()->hasRole('admin'))
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <!---------------------------------------------------------- Admin Starts ------------------------------------------------------------>
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <div class="admin-form row">
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="expense_head" class="form-control-label">Expense Head *</label>
                <!-- <select class="form-control expense_head" name="expense_head"
                    id="expense-head">
                    <option value="" disabled selected>Select Expense Head</option>
                </select> -->
                <input class="form-control expense_head" id="expense_head"
                    name="expense_head" type="text"
                    value="" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Enter expense head">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="name" class="form-control-label">Name *</label>
                <input class="form-control name" id="name"
                    name="name" type="text"
                    value="" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Enter name">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="date" class="form-control-label">Date *</label>
                <input class="form-control date" id="date"
                    name="date" type="date"
                    value="" onfocus="focused(this)"
                    onfocusout="defocused(this)" placeholder="Enter date">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="invoice_number" class="form-control-label">Invoice Number *</label>
                <input class="form-control invoice_number" id="invoice_number"
                    name="invoice_number" type="text"
                    value=""
                    onfocus="focused(this)" onfocusout="defocused(this)" placeholder="Enter invoice number">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="description" class="form-control-label">Description *</label>
                <textarea name="description" class="form-control" id="description" cols="1" rows="1"></textarea>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="amount" class="form-control-label">Amount *</label>
                <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter amount">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label for="file" class="form-control-label">Attach Document *</label>
                <input type="file" class="form-control" name="file" id="file">
            </div>
        </div>
        <hr class="horizontal dark">
    </div>
    <!------------------------------------------------------------------------------------------------------------------------------------>
    <!---------------------------------------------------------- Admin Ends -------------------------------------------------------------->
    <!------------------------------------------------------------------------------------------------------------------------------------>
    @endif
</div>
