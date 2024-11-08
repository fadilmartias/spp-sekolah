@if($type == 'text')
<div class="dropdown">
    <a href="javascript:void(0)" class="dropdown-toggle text-uppercase" role="button" id="dropdownLocale"
        data-bs-toggle="dropdown" aria-expanded="false">{{ session()->get('locale')['name'] ?? 'ENGLISH' }}</a>
    <ul class="dropdown-menu" aria-labelledby="dropdownLocale">
        @foreach (session()->get('locales') as $locale)
        <li>
            <form action="{{ route('locale.setLocale') }}" class="dropdown-item" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="code" value="{{ $locale['code'] }}">
                <input type="hidden" name="flag_code" value="{{ $locale['flag_code'] }}">
                <button type="submit" name="name" value="{{ $locale['name'] }}" class="btn btn-link text-decoration-none">{{ strtoupper($locale['name']) }}</button>
            </form>
        </li>
        @endforeach
    </ul>
</div>
@else
@php
    $locale = session()->get('locale')['flag_code'] ?? 'us';
@endphp
<div class="dropdown ms-1 topbar-head-dropdown header-item">
    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img id="" src="{{ asset('assets/images/flags/'. $locale .'.svg') }}" alt="Header Language" height="20" class="rounded">
    </button>
    <div class="dropdown-menu dropdown-menu-end">

        @foreach (session()->get('locales') as $locale)
            <form action="{{ route('locale.setLocale') }}" class="dropdown-item" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="code" value="{{ $locale['code'] }}">
                <input type="hidden" name="flag_code" value="{{ $locale['flag_code'] }}">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/images/flags/' . $locale['flag_code'] . '.svg') }}"alt="user-image" class="me-2 rounded" height="18">
                <button type="submit" name="name" value="{{ $locale['name'] }}" class="dropdown-item notify-item language">{{ strtoupper($locale['name']) }}</button>
                </div>
            </form>
        @endforeach

        {{-- <!-- item-->
        <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ar" title="Indonesian">
            <img src="{{ asset('assets/images/flags/id.svg') }}" alt="user-image" class="me-2 rounded" height="18">
            <span class="align-middle">Indonesian</span>
        </a> --}}
    </div>
</div>
@endif
