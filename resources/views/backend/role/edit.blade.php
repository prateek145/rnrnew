@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4x px-4x p-0">
        <div class="bg-light text-start rounded p-4">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Edit Role</h6>
                <a href="{{ route('role.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Return</a>
            </div>

            <div class="bg-light rounded h-100 p-0">

                <form action="{{ route('role.update', $role->id) }}" class="form-horizontal" enctype="multipart/form-data"
                    method="post">
                    @csrf
                    @method('put')
                    <div class="bg-light rounded h-100 p-4x">
                        {{-- <h6 class="mb-4">Audit </h6> --}}
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">General</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">Groups</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Rights</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                    aria-labelledby="pills-home-tab" tabindex="0">

                                    <div class="accordion" id="accordionPanelsStayOpenExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                                    aria-controls="panelsStayOpen-collapseOne">
                                                    General Information
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="mb-3 col-6">
                                                            <label for="exampleInputEmail1" class="form-label">Name</label>
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name" id="name" aria-describedby="namehelp"
                                                                value="{{ $role->name }}" required>
                                                            @error('name')
                                                                <label id="name-error" class="error text-danger"
                                                                    for="name">{{ $message }}</label>
                                                            @enderror
                                                            <div id="namehelp" class="form-text">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-6">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label">Status</label>
                                                            <select name="status" id=""
                                                                class="form-select @error('status') is-invalid @enderror">
                                                                <option value="1">Active</option>
                                                                <option value="0">In Active</option>
                                                            </select>
                                                            @error('status')
                                                                <label id="status-error" class="error text-danger"
                                                                    for="status">{{ $message }}</label>
                                                            @enderror
                                                            <div id="namehelp" class="form-text">
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-12">
                                                            <label for="exampleInputEmail1"
                                                                class="form-label @error('description') is-invalid @enderror">Description</label>
                                                            <textarea class="form-control" name="description" id="editor1">{{ $role->description }}</textarea>

                                                            @error('description')
                                                                <label id="description-error" class="error text-danger"
                                                                    for="description">{{ $message }}</label>
                                                            @enderror
                                                            <div id="namehelp" class="form-text">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                    aria-labelledby="pills-profile-tab" tabindex="0">

                                    <div class="accordion" id="accordionPanelsStayOpenExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-collapseOnex" aria-expanded="true"
                                                    aria-controls="panelsStayOpen-collapseOnex">
                                                    Groups
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseOnex"
                                                class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3 text-start">
                                                                <label for="filter"
                                                                    class="form-label">Groups&nbsp;</label><input
                                                                    id="filter" type="text"
                                                                    class="filter form-control"
                                                                    placeholder="Search Groups">
                                                                <br />

                                                                <div id="mdi"
                                                                    style="max-height: 10%; overflow:auto;">
                                                                    @foreach ($groups as $item)
                                                                        {{-- {{dd($item, $group->groupids)}} --}}
                                                                        @if ($role->groupids != null && in_array($item->id, json_decode($role->groupids)))
                                                                            <span><input class="talents_idmd-checkbox"
                                                                                    onchange="dragdrop(this.value, this.id, 'groupids[]');"
                                                                                    type="checkbox"
                                                                                    id="{{ $item->name . $item->lastname }}"
                                                                                    value="{{ $item->id }}"
                                                                                    checked>{{ $item->name . ' ' . $item->lastname }}</span><br>
                                                                        @else
                                                                            <span><input class="talents_idmd-checkbox"
                                                                                    onchange="dragdrop(this.value, this.id, 'groupids[]');"
                                                                                    type="checkbox"
                                                                                    id="{{ $item->name . $item->lastname }}"
                                                                                    value="{{ $item->id }}">{{ $item->name . ' ' . $item->lastname }}</span><br>
                                                                        @endif
                                                                    @endforeach
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="users" class="form-label">Selected
                                                                    Groups</label>
                                                                @php
                                                                    $groupids = json_decode($role->groupids);
                                                                    $groups1 = App\Models\backend\Group::find($groupids);
                                                                    if ($groups1) {
                                                                        # code...
                                                                    } else {
                                                                        # code...
                                                                        $groups1 = [];
                                                                    }
                                                                    
                                                                    // dd($groups1);
                                                                    
                                                                @endphp
                                                                <select name="groupids[]" id=""
                                                                    class="form-control" required multiple>
                                                                    @foreach ($groups1 as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            id="{{ $item->name }}" selected>
                                                                            {{ $item->name . ' ' . $item->lastname }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('group_id')
                                                        <label id="group_id-error" class="error text-danger"
                                                            for="group_id">{{ $message }}</label>
                                                    @enderror
                                                    <div id="namehelp" class="form-text">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <!--<div class="mb-3 row">
                                            <div class="col-md-12">-->


                                    <!--</div>
                                        </div>-->

                                </div>
                                <div class="tab-pane fade " id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab" tabindex="0">



                                    <div class="accordion" id="accordionPanelsStayOpenExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-collapseOnef" aria-expanded="true"
                                                    aria-controls="panelsStayOpen-collapseOnef">
                                                    Rights
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseOnef"
                                                class="accordion-collapse collapse show">
                                                <div class="accordion-body">


                                                    <div class="table-responsive">
                                                        <table
                                                            class="table text-start align-middle table-bordered table-hover mb-0">
                                                            <thead>
                                                                <tr class="text-dark">
                                                                    <th scope="col">Application Name</th>
                                                                    {{-- <th scope="col">Name</th> --}}
                                                                    <th scope="col">Create</th>
                                                                    <th scope="col">Read</th>
                                                                    <th scope="col">Update</th>
                                                                    <th scope="col">Delete</th>
                                                                    {{-- <th scope="col">Action</th> --}}
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($applications as $item)
                                                                    {{-- {{ dd($item) }} --}}
                                                                    @php
                                                                        $roleapp = App\Models\backend\Application_roles::where('roleid', $role->id)->where('applicationid', $item->id)->first();
                                                                        // dd();
                                                                    @endphp
                                                                    <tr>
                                                                        <td>
                                                                            <a href="#">
                                                                                {{ $item->name }}</a>

                                                                        </td>
                                                                        <td>
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    onchange="togglebtn(this.name, {{ $role->id }}, {{ $item->id }})"
                                                                                    name="create" type="checkbox"
                                                                                    id="flexSwitchCheckDefault" 
                                                                                    @if ($roleapp != null)
                                                                                    {{$roleapp->create == 1 ? 'checked':''}}
                                                                                    @endif  
                                                                                    >
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    name="read"
                                                                                    onchange="togglebtn(this.name, {{ $role->id }}, {{ $item->id }})"
                                                                                    type="checkbox"
                                                                                    id="flexSwitchCheckDefault"
                                                                                    @if ($roleapp != null)
                                                                                    {{$roleapp->read == 1 ? 'checked':'' ?? ""}}
                                                                                    @endif  
                                                                                    >
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    name="update"
                                                                                    onchange="togglebtn(this.name, {{ $role->id }}, {{ $item->id }})"
                                                                                    type="checkbox"
                                                                                    id="flexSwitchCheckDefault" 
                                                                                    @if ($roleapp != null)
                                                                                    {{$roleapp->update == 1 ? 'checked':'' ?? ""}}
                                                                                    @endif  
                                                                                    >
                                                                            </div>
                                                                        </td>

                                                                        <td>

                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    name="delete"
                                                                                    onchange="togglebtn(this.name, {{ $role->id }}, {{ $item->id }})"
                                                                                    type="checkbox"
                                                                                    id="flexSwitchCheckDefault" 
                                                                                    @if ($roleapp != null)
                                                                                    {{$roleapp->delete == 1 ? 'checked':'' ?? ""}}
                                                                                    @endif  
                                                                                    >
                                                                            </div>
                                                                        </td>
                                                                        {{-- <td class="d-flex justify-content-betweenx"><a
                                                                class="btn btn-sm btn-primary"
                                                                href="#">Assign
                                                                Role</a>

                                                        </td> --}}
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" value="{{ auth()->id() }}" name="updated_by">

                            <button type="submit" class="btn btn-primary mt-4">Submit</button>

                        </form>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');

        var status = "{{ $role->status }}";
        var currentstatus = document.getElementsByName('status')[0];
        for (let index = 0; index < currentstatus.length; index++) {
            if (currentstatus[index].value == status) {
                currentstatus[index].selected = true;
            }
        }

        function togglebtn(name, roleid, applicationid) {

            $.ajax({
                url: "{{ route('togglebtnroles') }}",
                method: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    "name": name,
                    "roleid": roleid,
                    "applicationid": applicationid
                },
                success: function(response) {
                    if (response.success == 'true') {
                        alert('success');
                    }
                    if (response.success == 'false') {
                        alert(response.error);
                    }

                }
            });
        }
    </script>
@endsection
