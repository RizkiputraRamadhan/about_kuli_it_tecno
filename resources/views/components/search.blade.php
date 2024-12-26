@if ($desktop)
    <form class="d-lg-inline d-none" action="" method="get">
        @if (request()->query('page'))
            <input type="hidden" class="form-control" name="page" value="{{ request()->query('page') }}"
                aria-label="Search">
        @endif
        @if (request()->query('departement'))
            <input type="hidden" class="form-control" name="departement" value="{{ request()->query('departement') }}"
                aria-label="Search">
        @endif
        @if (request()->query('datetimes'))
            <input type="hidden" class="form-control" name="datetimes" value="{{ request()->query('datetimes') }}"
                aria-label="Search">
        @endif
        <div class="input-group">
            <input type="text" class="form-control" name="query" placeholder="Cari Data Disini..."
                aria-label="Search" value="{{ request()->query('query') }}">
            <button class="btn btn-outline-primary" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form>
@endif

@if ($mobile)
    <div class="p-3 d-lg-none">
        <form action="" method="get">
            @if (request()->query('page'))
                <input type="hidden" class="form-control" name="page" value="{{ request()->query('page') }}"
                    aria-label="Search">
            @endif
            @if (request()->query('departement'))
                <input type="hidden" class="form-control" name="departement"
                    value="{{ request()->query('departement') }}" aria-label="Search">
            @endif
            @if (request()->query('datetimes'))
                <input type="hidden" class="form-control" name="datetimes" value="{{ request()->query('datetimes') }}"
                    aria-label="Search">
            @endif
            <div class="input-group">
                <input type="text" class="form-control" name="query" placeholder="Cari Data Disini..."
                    value="{{ request()->query('query') }}" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
@endif
