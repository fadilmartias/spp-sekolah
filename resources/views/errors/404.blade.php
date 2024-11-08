<x-errors.layout type="error" code="404" title="{{ __('errors.404_title') }}"
    img-url="{{ asset('assets/images/error400-cover.png') }}" heading="{{ __('errors.404_heading') }}"
    content="{{ __('errors.404_content') }}" btn-url="{{ route('admin.dashboard.index') }}"
    btn-text="{{ __('errors.404_btn_text') }}" btn-icon="<i class='mdi mdi-home me-1'></i>" />
