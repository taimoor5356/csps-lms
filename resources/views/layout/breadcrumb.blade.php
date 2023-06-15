<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="text-light" href="javascript:;">{{$institute_name}}</a></li>
        <li class="breadcrumb-item text-sm text-white" aria-current="page">{{$tab_name}}<a href="{{ route('students') }}"
                class="text-white"></a></li>
        <li class="breadcrumb-item text-sm text-white active" aria-current="page"><span
                class="text-light">{{$page_title}}</span></li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">{{$page_title}}</h6>
</nav>