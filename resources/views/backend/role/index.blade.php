@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4x px-4x p-0">
        <div class="bg-light text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Roles</h6>
                <a href="{{ route('role.create') }}" class="btn btn-primary"> <i class="bi bi-plus"></i> Add Role</a>

            </div>

            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Name</th>
                            {{-- <th scope="col">Name</th> --}}
                            {{-- <th>Group Name</th> --}}
                            <th scope="col">Status</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Updated By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $item)
                            {{-- {{ dd($item) }} --}}
                            <tr>
                                <td>
                                    <a href="{{ route('role.edit', $item->id) }}"> {{ $item->name }}</a>

                                </td>

                                {{-- <td>
                                    @php
                                        $groupids = json_decode($item->groupids);
                                        $goups = App\Models\backend\Group::find($groupids);
                                        
                                    @endphp
                                    @foreach ($goups as $item1)
                                        <span>{{ $item1->name }}</span> 
                                    @endforeach

                                </td> --}}
                                <td>
                                    @if ($item->status == 1)
                                        Active
                                    @else
                                        In-Active
                                    @endif
                                </td>

                                <td>
                                    {{ $item->rolecreatedby->name ?? "none" }}
                                </td>

                                <td>
                                    {{ $item->roleupdatedby->name ?? 'none' }}
                                </td>
                                <td>{{ $item->created_at == true ? $item->created_at->toDateString() : ""}}</td>
                                <td>{{ $item->updated_at == true ? $item->updated_at->toDateString() : ""}}</td>
                                <td class="d-flex justify-content-betweenx"><a class="btn btn-sm btn-warning m-1"
                                        href="{{ route('role.edit', $item->id) }}">Edit</a>

                                    <form action="{{ route('role.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-sm btn-danger m-1" onclick="return confirm('Are You Sure ?')"
                                            type="submit" value="Delete">
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
@endsection
