@extends('layouts.admin')
@section('title', 'Music Article List')
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
                // responsive: true,
                columnDefs: [{
                    targets: 0,
                    searchable: false,
                    orderable: false,
                    width: '5%'
                }, {
                    targets: 1,
                    width: '20%'
                },{
                    targets: 3,
                    width: '40%'
                }]
            });
        });

        const confirmDelete = (id) => {
            Swal.fire({
                iconHtml: '<lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>',
                title: 'Are you sure?',
                text: 'You want to delete this article',
                showCancelButton: true,
                confirmButtonColor: '#405189',
                cancelButtonColor: '#f06548',
                confirmButtonText: 'Yes, delete it!',
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
                url: `{{ route('admin.music-article.updateStatus') }}`,
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
                    <a href="{{ route('admin.music-article.action') }}" class="btn btn-primary">Add Article</a>
                </div>
                <div class="card-body table-responsive">
                    <table id="table" class="table table-bordered nowrap table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th data-ordering="false">No.</th>
                                <th>Title</th>
                                {{-- <th>Author</th> --}}
                                <th>Tag</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="">{{ $item->title }}</td>
                                    {{-- <td>{{ $item->author }}</td> --}}
                                    <td>{{ implode(', ', json_decode($item->tag, true) ?? []) }}</td>
                                    <td id="status-{{ $item->id }}">
                                        @switch($item->status)
                                            @case(0)
                                                <span class="badge bg-secondary">Draft</span>
                                            @break
                                            @case(1)
                                                <span class="badge bg-success">Publish</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button onclick="updateStatus({{ $item->id }} ,{{ $item->status }})"
                                                class="btn btn-secondary btn-sm">{{ $item->status == 0 ? 'Publish' : 'Draft' }}</button>
                                            <a href="{{ route('admin.music-article.action', $item->id) }}"
                                                class="btn btn-warning btn-sm">Edit</a>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ $item->id }}')">Delete</button>
                                            <form action="{{ route('admin.music-article.delete', $item->id) }}"
                                                method="POST" id="delete-{{ $item->id }}">
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
        </div><!--end col-->
    </div><!--end row-->
@endsection