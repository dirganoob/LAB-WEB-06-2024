@if (Session::has('success'))
    <div class="position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 1050; width: 90%; max-width: 500px;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 1050; width: 90%; max-width: 500px;">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif
