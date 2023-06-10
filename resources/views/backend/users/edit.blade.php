@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4x px-4x p-0">
        <div class="bg-light text-start rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Edit User</h6>
                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Return</a>
            </div>
            <div class="bg-light rounded h-100 p-0">
                {{-- <h6 class="mb-4">Audit </h6> --}}
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">General</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Groups</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Roles</button>
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
                                                <label for="exampleInputEmail1" class="form-label">First Name</label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                                    id="name" aria-describedby="namehelp" value="{{ $user->name }}"
                                                    required>
                                                @error('name')
                                                    <label id="name-error" class="error text-danger"
                                                        for="name">{{ $message }}</label>
                                                @enderror
                                                <div id="namehelp" class="form-text">
                                                </div>
                                            </div>

                                            <div class="mb-3 col-6">
                                                <label for="exampleInputEmail1" class="form-label">Last Name</label>
                                                <input type="text"
                                                    class="form-control @error('lastname') is-invalid @enderror"
                                                    name="lastname" id="lastname" value="{{ $user->lastname }}"
                                                    aria-describedby="lastnamehelp" required>
                                                @error('lastname')
                                                    <label id="lastname-error" class="error text-danger"
                                                        for="lastname">{{ $message }}</label>
                                                @enderror
                                                <div id="lastnamehelp" class="form-text">
                                                </div>
                                            </div>

                                            <div class="mb-3 col-12">
                                                <label for="exampleInputEmail1" class="form-label">User ID</label>
                                                <input type="text"
                                                    class="form-control @error('lastname') is-invalid @enderror"
                                                    name="custom_userid" id="lastname" value="{{ $user->custom_userid }}"
                                                    aria-describedby="lastnamehelp" required>
                                                @error('lastname')
                                                    <label id="lastname-error" class="error text-danger"
                                                        for="lastname">{{ $message }}</label>
                                                @enderror
                                                <div id="lastnamehelp" class="form-text">
                                                </div>
                                            </div>
                                            
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                            Contact Information
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <div class="row">
                                            <div class="mb-3 col-6">
                                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                                <input type="text"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="email" name="email" aria-describedby="namehelp"
                                                    value="{{ $user->email }}" required>
                                                @error('email')
                                                    <label id="email-error" class="error text-danger"
                                                        for="email">{{ $message }}</label>
                                                @enderror
                                                <div id="namehelp" class="form-text">
                                                </div>
                                            </div>

                                            <div class="mb-3 col-6">
                                                <label for="exampleInputEmail1"
                                                    class="form-label @error('mobile_no') is-invalid @enderror">Mobile
                                                    No</label>
                                                <input type="text" class="form-control" id="name"
                                                    value="{{ $user->mobile_no }}" name="mobile_no"
                                                    aria-describedby="namehelp" required>
                                                @error('mobile_no')
                                                    <label id="mobile_no-error" class="error text-danger"
                                                        for="mobile_no">{{ $message }}</label>
                                                @enderror
                                                <div id="namehelp" class="form-text">
                                                </div>
                                            </div>

                                            <div class="mb-3 col-12">
                                                <label for="exampleInputEmail1"
                                                    class="form-label @error('department') is-invalid @enderror">Status</label>
                                                <select name="status" id="" class="form-select" required>
                                                    <option value="">Select Status</option>
                                                    <option selected value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                                @error('group_id')
                                                    <label id="group_id-error" class="error text-danger"
                                                        for="group_id">{{ $message }}</label>
                                                @enderror
                                                <div id="namehelp" class="form-text">
                                                </div>
                                            </div>


                                            <!--<div class="mb-3 col-6">-->

                                                
                                                    <div class="mb-3 col-6">
                                                        <label for="exampleInputEmail1"
                                                            class="form-label @error('password') is-invalid @enderror">Password</label>
                                                        <input type="password" class="form-control" id="name"
                                                            name="password" aria-describedby="namehelp">
                                                        @error('password')
                                                            <label id="password-error" class="error text-danger"
                                                                for="password">{{ $message }}</label>
                                                        @enderror
                                                        <div id="namehelp" class="form-text">
                                                        </div>
                                                    </div>

                                                    <div class="mb-3 col-6">
                                                        <label for="exampleInputEmail1"
                                                            class="form-label @error('password_confirmation') is-invalid @enderror">Re-Password</label>
                                                        <input type="password" class="form-control" id="name"
                                                            name="password_confirmation" aria-describedby="namehelp">
                                                        @error('password_confirmation')
                                                            <label id="password_confirmation-error" class="error text-danger"
                                                                for="password_confirmation">{{ $message }}</label>
                                                        @enderror
                                                        <div id="namehelp" class="form-text">
                                                        </div>
                                                    </div>
                                                

                                            <!--</div>-->

                                            <div class="col-md-12 mb-2">
                                                <label for="remarks" class="form-label"> SHHkey/Token/Certificate </label>
                                                <textarea name="remarks" id="" cols="30" rows="4" class="form-control">
                                                    {{ $user->remarks }}
                                                </textarea>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab" tabindex="0">

                            <div class="accordion" id="accordionExample">
                                @if ($usergroups != null)
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
                                                    {{-- <th scope="col">Action</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($groups as $item)
                                                    <tr>
                                                        <td>
                                                            <a
                                                                href="{{ route('group.edit', $item->id) }}">{{ $item->name }}</a>
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
                                                                $create = App\Models\User::find($item->created_by);
                                                                $created_by = $create->name;
                                                            } else {
                                                                $created_by = 'none';
                                                            }
                                                        @endphp
                                                        <td>{{ $created_by }}</td>

                                                        @php
                                                            if ($item->updated_by) {
                                                                $update = App\Models\User::find($item->updated_by);
                                                                $updated_by = $update->name;
                                                            } else {
                                                                $updated_by = 'none';
                                                            }
                                                        @endphp
                                                        <td>{{ $updated_by }}</td>

                                                        <td>{{ $item->created_at == true ? $item->created_at->toDateString() : '' }}
                                                        </td>
                                                        <td>{{ $item->updated_at == true ? $item->updated_at->toDateString() : '' }}
                                                        </td>
                                                        {{-- <td class="d-flex justify-content-betweenx"><a
                                                            class="btn btn-sm btn-primary"
                                                            href="{{ route('group.edit', $item->id) }}">Edit</a>

                                                        <form action="{{ route('group.destroy', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are You Sure ?')" type="submit"
                                                                value="Delete">
                                                        </form>
                                                    </td> --}}
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Group Selection
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="mb-3 row">
                                                <div class="col-md-12">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3 text-start">
                                                                <label for="filter" class="form-label">Groups&nbsp;</label><input
                                                                    id="filter" type="text"
                                                                    class="filter form-control"
                                                                    placeholder="Search Groups">
                                                                <br />

                                                                <div id="mdi"
                                                                    style="max-height: 10%; overflow:auto;">
                                                                    @foreach ($groups as $item)
                                                                        {{-- {{dd($user)}} --}}
                                                                        @if ($user->groupids != null && in_array($item->id, json_decode($user->groupids)))
                                                                            <span><input class="talents_id md-checkbox form-check float-start mx-1"
                                                                                    onchange="dragdrop(this.value, this.id, 'groupids[]');"
                                                                                    type="checkbox"
                                                                                    id="{{ $item->name }}"
                                                                                    value="{{ $item->id }}"
                                                                                    checked>{{ $item->name . ' ' . $item->lastname }}</span><br>
                                                                        @else
                                                                            <span><input class="talents_id md-checkbox form-check float-start mx-1"
                                                                                    onchange="dragdrop(this.value, this.id, 'groupids[]');"
                                                                                    type="checkbox"
                                                                                    id="{{ $item->name }}"
                                                                                    value="{{ $item->id }}">{{ $item->name . ' ' . $item->lastname }}</span><br>
                                                                        @endif
                                                                    @endforeach
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="users" class="form-label">Selected Groups</label>
                                                                @php
                                                                    $groupids = json_decode($user->groupids);
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
                                                                    class="form-control" multiple>
                                                                    @foreach ($groups1 as $item)
                                                                        <option value="{{ $item->id }}"
                                                                            id="{{ $item->name }}">
                                                                            {{ $item->name }}
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
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab" tabindex="0">

                            @if ($userroles != null)
                                <div class="table-responsive">
                                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr class="text-dark">
                                                <th scope="col">Name</th>
                                                {{-- <th scope="col">Name</th> --}}
                                                <th>Group Name</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Created By</th>
                                                <th scope="col">Updated By</th>
                                                <th scope="col">Created At</th>
                                                <th scope="col">Updated At</th>
                                                {{-- <th scope="col">Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userroles as $item)
                                                {{-- {{ dd($item) }} --}}
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('role.edit', $item->id) }}">
                                                            {{ $item->name }}</a>

                                                    </td>

                                                    <td>
                                                        @php
                                                            $groupids = json_decode($item->groupids);
                                                            $goups = App\Models\backend\Group::find($groupids);
                                                            
                                                        @endphp
                                                        @foreach ($goups as $item1)
                                                            <span>{{ $item1->name }}</span>
                                                        @endforeach

                                                    </td>
                                                    <td>
                                                        @if ($item->status == 1)
                                                            Active
                                                        @else
                                                            In-Active
                                                        @endif
                                                    </td>

                                                    <td>
                                                        @php
                                                            if ($item->created_by) {
                                                                $rolename = App\Models\User::find($item->created_by);
                                                                $createdby = $rolename->name;
                                                            } else {
                                                                $createdby = 'none';
                                                            }
                                                        @endphp
                                                        {{ $createdby }}
                                                    </td>

                                                    <td>
                                                        @php
                                                            if ($item->updated_by) {
                                                                $rolesname = App\Models\User::find($item->updated_by);
                                                                $updatedby = $rolesname->name;
                                                            } else {
                                                                $updatedby = 'none';
                                                            }
                                                        @endphp
                                                        {{ $updatedby }}
                                                    </td>
                                                    <td>{{ $item->created_at == true ? $item->created_at->toDateString() : '' }}
                                                    </td>
                                                    <td>{{ $item->updated_at == true ? $item->updated_at->toDateString() : '' }}
                                                    </td>
                                                    {{-- <td class="d-flex justify-content-betweenx"><a
                                                            class="btn btn-sm btn-warning"
                                                            href="{{ route('role.edit', $item->id) }}">Edit</a>

                                                        <form action="{{ route('role.destroy', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Are You Sure ?')" type="submit"
                                                                value="Delete">
                                                        </form>

                                                    </td> --}}
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            @endif

                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Role Selection
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="mb-3 row">
                                                <div class="col-md-12">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3 text-start">
                                                                <label for="filter" class="form-label">Role&nbsp;</label><input
                                                                    id="filter" type="text"
                                                                    class="filter form-control"
                                                                    placeholder="Search Roles">
                                                                <br />

                                                                <div id="mdi"
                                                                    style="max-height: 10%; overflow:auto;">
                                                                    @foreach ($roles as $item)
                                                                        @if ($user->roleids != null && in_array($item->id, json_decode($user->roleids)))
                                                                            <span><input class="talents_id md-checkbox form-check float-start mx-1"
                                                                                    onchange="dragdrop(this.value, this.id, 'roleids[]');"
                                                                                    type="checkbox"
                                                                                    id="{{ $item->name }}"
                                                                                    value="{{ $item->id }}"
                                                                                    checked>{{ $item->name }}</span><br>
                                                                        @else
                                                                            <span><input class="talents_id md-checkbox form-check float-start mx-1"
                                                                                    onchange="dragdrop(this.value, this.id, 'roleids[]');"
                                                                                    type="checkbox"
                                                                                    id="{{ $item->name }}"
                                                                                    value="{{ $item->id }}">{{ $item->name }}</span><br>
                                                                        @endif
                                                                    @endforeach
                                                                </div>


                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="users" class="form-label">Selected Groups</label>
                                                                @php
                                                                $roleids = json_decode($user->roleids);
                                                                $roles1 = App\Models\backend\Role::find($roleids);
                                                                // dd($roles1);
                                                                if ($roles1) {
                                                                    # code...
                                                                } else {
                                                                    # code...
                                                                    $roles1 = [];
                                                                }
                                                                
                                                                // dd($groups1);
                                                                
                                                            @endphp
                                                            <select name="roleids[]" id=""
                                                                class="form-control" multiple>
                                                                @foreach ($roles1 as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        id="{{ $item->name }}">
                                                                        {{ $item->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('roleids')
                                                        <label id="roleids-error" class="error text-danger"
                                                            for="roleids">{{ $message }}</label>
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
                        <input type="submit" class="btn btn-primary mt-5" value="Submit">
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->

    <script>
        var status = "{{ $user->status }}";
        var currentstatus = document.getElementsByName('status')[0];
        for (let index = 0; index < currentstatus.length; index++) {
            if (currentstatus[index].value == status) {
                currentstatus[index].selected = true;
            }
        }
    </script>
@endsection
