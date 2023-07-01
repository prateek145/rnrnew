@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Reports Filter</h6>

            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Application Name</th>
                            <th scope="col">Data</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            {{-- <th scope="col">Updated At</th> --}}
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formdatas as $item)
                            {{-- {{ dd($item) }} --}}
                            <tr>
                                <td>
                                    {{$item->formapplicaiton->name}}

                                </td>
                                <td>
                                    {{$item->data}}
                                </td>
                                <td>{{ $item->created_at->toDateString() }}</td>
                                <td>{{ $item->updated_at->toDateString() }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
