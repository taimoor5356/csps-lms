@extends('layout.app')
@section('content')
@section('style')
    <!-- Styling Here -->
    <style>
        .revenue-modal-card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .revenue-modal-card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }
        .child-table>tr>td {
            border: 1px solid lightgrey;
        }
    </style>
    <!-- Styling Here -->
@endsection
@section('breadcrumbs')
    @include('layout.breadcrumb', ['institute_name' => 'CSPs', 'tab_name' => 'Revenue', 'page_title' => 'Fee Plan / Fee Collection'])
@endsection
<!-- Section Body -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Fee Plan / Fee Collection</h6>
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
                <div class="card-body px-0 pt-0 pb-2">
                    <small class="mx-3 text-danger">* Scroll right if unable to see Actions</small>
                    @include('revenue._table')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Section Body -->
@endsection
<!-- Section Modal -->
@section('modal')

@endsection
<!-- Section Modal -->
@section('page_js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Scripting Here -->
<script>
    $(document).ready(function() {
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
        // Data Table Starts
        var table = $('.data-table').DataTable({
            responsive: true,
            processing: true,
            // stateSave: true,
            serverSide: true,
            bDestroy: true,
            scrollX: true,
            autoWidth: false,
            ajax: {
                url: "{{ route('fee_collection') }}",
            },
            columns: [
                // {
                //     data: 'class',
                //     name: 'class'
                // },
                {
                    data: 'batch',
                    name: 'batch'
                },
                {
                    data: 'registration_number',
                    name: 'registration_number'
                },
                {
                    data: 'student_name',
                    name: 'student_name'
                },
                {
                    data: 'phone',
                    name: 'phone'
                },
                {
                    data: 'fee_total',
                    name: 'fee_total',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'discount',
                    name: 'discount',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'fee_paid',
                    name: 'fee_paid',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'fee_remaining',
                    name: 'fee_remaining',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            initComplete: function(settings, json) {
                $('body').find('.dataTables_scrollBody').addClass("custom-scrollbar");
                $('body').find('.dataTables_paginate.paging_simple_numbers').addClass(
                    "custom-pagination");
                $('body').find('.dataTables_wrapper .custom-pagination .paginate_button').addClass(
                    "text-color");
            }
        });
        // Data Table Ends

        $(document).on('click', '.send-fee-reminder', function() {
            var _this = $(this);
            var studentId = _this.attr('data-student-id');
            var url = "{{route('send_fee_reminder', ':student_id')}}";
            url = url.replace(':student_id', studentId);
            var data = {
                '_token':'{{csrf_token()}}',
            };
            $.post(url, data, function(response) {
                if (response.status == true) {
                    table.draw(false);
                    alert('Successfull');
                } else if (response.status == false) {
                    alert('Something went wrong');
                }
            });
        });
    });
</script>
<!-- Scripting Here -->
@endsection