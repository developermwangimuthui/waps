@if (session()->has('success'))
    <div class="alert alert-success dark alert-dismissible fade show" role="alert"> {{ session('success') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger dark alert-dismissible fade show" role="alert"> {{ session('error') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('info'))
    <div class="alert alert-info dark alert-dismissible fade show" role="alert">{{ session('info') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
