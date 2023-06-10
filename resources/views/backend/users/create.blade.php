@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4x px-4x p-0">
        <div class="bg-light text-start rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Create User</h6>
                <a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Return</a>
            </div>
            <div class="bg-light rounded h-100 p-4x">
                {{-- <h6 class="mb-4">Audit </h6> --}}
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                                                    id="name" aria-describedby="namehelp" required>
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
                                                    name="lastname" id="lastname" aria-describedby="lastnamehelp" required>
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
                                                    name="custom_userid" id="lastname" aria-describedby="lastnamehelp"
                                                    required>
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
                                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" aria-describedby="namehelp" required>
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
                                                <input type="text" class="form-control" id="name" name="mobile_no"
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
    
    
                                            <div class="mb-3  col-6">
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
                                                            class="form-label @error('repassword') is-invalid @enderror">Re-Password</label>
                                                        <input type="password" class="form-control" id="name"
                                                            name="repassword" aria-describedby="namehelp">
                                                        @error('repassword')
                                                            <label id="repassword-error" class="error text-danger"
                                                                for="repassword">{{ $message }}</label>
                                                        @enderror
                                                        <div id="namehelp" class="form-text">
                                                        </div>
                                                    </div>
    
                                            <div class="col-md-12 mb-2">
                                                <label for="remarks" class="form-label">SHHkey/Token/Certificate</label>
                                                <textarea name="remarks" id="" cols="30" rows="4" class="form-control">
                                                    
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
                            
                            
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseOnex" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseOnex">
                                            Groups
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOnex" class="accordion-collapse collapse show">
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
                                                        <span><input class="talents_idmd-checkbox"
                                                                onchange="dragdrop(this.value, this.id, 'groupids[]');"
                                                                type="checkbox"
                                                                id="{{ $item->name . ' ' . $item->lastname }}"
                                                                value="{{ $item->id }}">{{ $item->name . ' ' . $item->lastname }}</span><br>
                                                    @endforeach
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="users" class="form-label">Selected Groups</label>
                                                <select name="groupids[]" id=""
                                                    class="form-control" multiple>
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
                            
                             <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapseOnez" aria-expanded="true"
                                            aria-controls="panelsStayOpen-collapseOnez">
                                            Roles
                                        </button>
                                    </h2>
                                    <div id="panelsStayOpen-collapseOnez" class="accordion-collapse collapse show">
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
                                                        <span><input class="talents_idmd-checkbox"
                                                                onchange="dragdrop(this.value, this.id, 'roleids[]');"
                                                                type="checkbox"
                                                                id="{{$item->name}}"
                                                                value="{{ $item->id }}">{{ $item->name}}</span><br>
                                                    @endforeach
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="users" class="form-label">Selected Groups</label>
                                                <select name="roleids[]" id=""
                                                    class="form-control" multiple>
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

    {{-- <script>
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
            console.log(value, name);
            if (document.getElementById(name).checked) {
                var userselect = document.getElementsByName('group_id[]')[0];
                var option = document.createElement('option');
                option.value = value;
                option.id = value;
                option.innerText = name;
                option.selected = true;
                userselect.appendChild(option);
            } else {
                var userselect = document.getElementsByName('group_id[]')[0];
                var removeoption = document.getElementById(value);
                userselect.removeChild(removeoption);
            }
        }
    </script> --}}
@endsection
