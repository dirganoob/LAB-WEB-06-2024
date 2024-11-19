@extends('layouts.master')

@section('title', 'About')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="text-center mb-4"><b>About Me</b></h2>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="mb-4 text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ut interdum leo, sed luctus velit. In volutpat massa ut justo facilisis imperdiet. Aenean ultricies augue id ex cursus, vitae venenatis lorem luctus. Donec eu neque finibus, bibendum justo quis, laoreet mi. Morbi non scelerisque erat. Vivamus tincidunt sapien ac enim tristique bibendum. Donec ullamcorper mi non congue bibendum. Etiam a facilisis purus. Fusce pharetra metus ac sapien blandit, non dignissim felis auctor. Sed imperdiet orci nulla, vitae pretium tortor efficitur sit amet. Curabitur ac urna vitae sapien varius dignissim. Nam maximus neque non tempor pulvinar. Mauris sagittis luctus vehicula. Morbi tincidunt justo in tellus auctor sodales non vitae massa.
                            </p>
                            <p class="mb-4 text-justify">
                            Maecenas tortor odio, fringilla sit amet ultricies eget, tincidunt pulvinar tellus. Sed ac nisi elit. Sed rutrum leo malesuada malesuada fringilla. Integer sagittis sollicitudin accumsan. Donec at aliquam mi. Aliquam gravida imperdiet sem ut iaculis. Vivamus eleifend in lorem vitae convallis. Phasellus iaculis lacinia ornare. Phasellus pulvinar sed enim nec dictum.
                            </p>
                            <p class="mb-4 text-justify">
                            Sed a elit maximus, convallis neque nec, interdum turpis. Proin augue risus, lobortis nec tincidunt et, suscipit imperdiet metus. Aenean rhoncus accumsan eros. Nunc dictum est at mauris facilisis posuere. Cras semper nec nunc vel congue. Aliquam erat volutpat. Suspendisse viverra purus accumsan arcu maximus facilisis. Integer aliquet mi et urna pellentesque, ut vestibulum velit posuere. Proin volutpat vitae justo vel rutrum.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    @include('partials.footer')  
@endsection
