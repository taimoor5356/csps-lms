@extends('layout.app')
@section('content')
@section('style')
    <!-- Styling Here -->
    <style>
        .teacher-review-modal-card {
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

        .teacher-review-modal-card-body {
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

.rating i {
    color: #ccc;
    /* Default star color */
}

.rating i:hover {
    color: #ffcc00;
    /* Hovered star color */
}

.rating i.active {
    color: #ffcc00;
    /* Active star color */
}
    </style>
    <!-- Styling Here -->
@endsection
@section('breadcrumbs')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">CSPs</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span
                    class="text-light">Teacher Review</span></li>
        </ol>
        <h6 class="font-weight-bolder text-white mb-0">Teacher Review</h6>
    </nav>
@endsection
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex">
                    <h6>Teacher Review</h6>
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
                    <form action="{{route('store.teacher_review')}}" method="POST">
                        @csrf
                        @include('teacher_review._table')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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

        $(".rating i").on("mouseover", function() {
            const rating = $(this).data("rating");
            updateStarsColor(rating);
        });

        $(".rating i").on("click", function() {
            const rating = $(this).data("rating");
            $("#rating").val(rating);
        });

        $(".rating").on("mouseout", function() {
            const currentRating = $("#rating").val();
            updateStarsColor(currentRating);
        });

        function updateStarsColor(rating) {
            $(".rating i").each(function() {
                const currentRating = $(this).data("rating");
                if (currentRating <= rating) {
                    $(this).addClass("active");
                } else {
                    $(this).removeClass("active");
                }
            });
        }
    });
</script>
<!-- Scripting Here -->
@endsection
