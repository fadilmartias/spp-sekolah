<x-errors.layout type="error" code="500" title="{{ __('errors.500_title') }}"
    img-url="{{ asset('assets/images/error500.png') }}" heading="{{ __('errors.500_heading') }}"
    content="{{ __('errors.500_content') }}" btn-url="{{ route('admin.dashboard.index') }}"
    btn-text="{{ __('errors.500_btn_text') }}" btn-icon="<i class='mdi mdi-home me-1'></i>" />
