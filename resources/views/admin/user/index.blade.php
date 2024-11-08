@extends('layouts.admin')
@section('title', __('vocab.list', ['data' => __('vocab.user')]))
@push('style')
<!--datatable css-->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
<!--datatable responsive css-->
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
<link href="{{ asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('script')
<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script>
    $(document).ready(function() {
            $('#table').DataTable({
                responsive: true,
                columnDefs: [{
                    targets: 0,
                    searchable: false,
                    orderable: false,
                    width: '5%'
                }, {
                    targets: 6,
                    searchable: false,
                    orderable: false,
                    width: '5%'
                }]
            });
        });

        const confirmDelete = (id) => {
            Swal.fire({
                iconHtml: '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>',
                title: `{{ __('message.are_you_sure') }}`,
                text: `{{ __('message.you_want_to_delete', ['data' => __('vocab.user')]) }}`,
                showCancelButton: true,
                confirmButtonColor: '#405189',
                cancelButtonColor: '#f06548',
                confirmButtonText: `{{ __('message.yes_delete') }}`,
                customClass: {
                    icon: 'border-0'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-${id}`).submit();
                }
            });
        }

        const updateStatus = (id, status) => {
            $.ajax({
                url: `{{ route('admin.user.updateStatus') }}`,
                type: 'PATCH',
                data: {
                    id: id,
                    status: status == 0 ? 1 : 0,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success: (res) => {
                    if(res.status) {
                        location.reload();
                    }
                    console.log(res);
                },
                error: (err) => {
                    console.log(err);
                }
            })
        }
</script>
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ route('admin.user.action') }}" class="btn btn-primary">{{ __('vocab.add', ['data' => __('vocab.user')]) }}</a>
            </div>
            <div class="card-body">
                <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                    style="width:100%">
                    <thead>
                        <tr>
                            <th data-ordering="false">No.</th>
                            <th>{{ __('vocab.name') }}</th>
                            <th>{{ __('vocab.email') }}</th>
                            <th>{{ __('vocab.username') }}</th>
                            <th>{{ __('vocab.status') }}</th>
                            <th>{{ __('vocab.role') }}</th>
                            <th>{{ __('vocab.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->username ?? 'kosong' }}</td>
                            <td>
                                @switch($item->status)
                                @case(0)
                                <span class="badge bg-secondary">{{ __('vocab.inactive') }}</span>
                                @break
                                @case(1)
                                <span class="badge bg-success">{{ __('vocab.active') }}</span>
                                @break
                                @endswitch
                            </td>
                            <td class="text-capitalize">{{ $item->getRoleNames()->first() }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    @if ($item->id != Auth::user()->id)
                                    <button onclick="updateStatus({{ $item->id }} ,{{ $item->status }})"
                                        class="btn btn-secondary btn-sm">{{ $item->status == 0 ? __('vocab.activate', ['data' => '']) :
                                        __('vocab.deactivate', ['data' => '']) }}</button>
                                    @endif

                                    <a href="{{ route('admin.user.action', $item->id) }}"
                                        class="btn btn-warning btn-sm">{{ __('vocab.edit', ['data' => '']) }}</a>
                                    @if ($item->id != Auth::id())
                                    <button class="btn btn-danger btn-sm"
                                        onclick="confirmDelete('{{ $item->id }}')">{{ __('vocab.delete', ['data' => '']) }}</button>
                                    @endif
                                    <form action="{{ route('admin.user.delete', $item->id) }}" method="POST"
                                        id="delete-{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--end col-->
</div>
<!--end row-->
@endsection
