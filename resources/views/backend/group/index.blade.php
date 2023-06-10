@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4x px-4x p-0">
        <div class="bg-light text-start rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Groups</h6>
                <a href="{{ route('group.create') }}"  class="btn btn-primary"><i class="bi bi-people"></i> Add Group</a>

            </div>
            <div class="table-responsive">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-dark">
                            <th scope="col">Name</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Updated By</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $item)
                            <tr>
                                <td>
                                    <a href="{{ route('group.edit', $item->id) }}">{{ $item->name }}</a>
                                </td>
                                <td>
                                    @if ($item->status == 1)
                                        Active
                                    @else
                                        InActive
                                    @endif
                                </td>
                                @php
                                    if ($item->created_by) {
                                        $created = App\Models\User::find($item->created_by);
                                        $created_by = $created->name;
                                    } else {
                                        $created_by = 'none';
                                    }
                                @endphp
                                <td>{{ $created_by }}</td>

                                @php
                                    if ($item->updated_by) {
                                        $updated = App\Models\User::find($item->updated_by);
                                        $updated_by = $updated->name;
                                    } else {
                                        $updated_by = 'none';
                                    }
                                @endphp
                                <td>{{ $updated_by }}</td>

                                <td>{{ $item->created_at == true ? $item->created_at->toDateString() : '' }}</td>
                                <td>{{ $item->updated_at == true ? $item->updated_at->toDateString() : '' }}</td>
                                <td class="d-flex justify-content-betweenx"><a class="btn btn-sm btn-primary m-1"
                                        href="{{ route('group.edit', $item->id) }}">Edit</a>

                                    <form action="{{ route('group.destroy', $item->id) }}" method="post">
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

    <script>
        const filterEl = document.querySelector('#filter');
        const els = Array.from(document.querySelectorAll('#mdi > span'));
        const labels = els.map(el => el.textContent);
        const handler = value => {
            const matching = labels.map((label, idx, arr) => label.toLowerCase().includes(value.toLowerCase()) ? idx :
                null).filter(el => el != null);

            els.forEach((el, idx) => {
                if (matching.includes(idx)) {
                    els[idx].style.display = 'block';
                } else {
                    els[idx].style.display = 'none';
                }
            });
        };

        filterEl.addEventListener('keyup', () => handler.call(null, filterEl.value));


        function dragdrop(value, name) {
            // console.log(value);
            if (document.getElementById(name).checked) {
                var userselect = document.getElementsByName('userids[]')[0];
                var option = document.createElement('option');
                option.value = value;
                option.id = value;
                option.innerText = name;
                option.selected = true;
                userselect.appendChild(option);
            } else {
                var userselect = document.getElementsByName('userids[]')[0];
                var removeoption = document.getElementById(value);
                userselect.removeChild(removeoption);
            }
        }
    </script>
@endsection
