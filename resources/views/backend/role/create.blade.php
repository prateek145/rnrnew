@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4x px-4x p-0">
        <div class="bg-light text-start rounded p-4">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Create Role</h6>
                <a href="{{ route('role.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Return</a>
            </div>
            <div class="bg-light rounded h-100 p-4x">
                <form action="{{ route('role.store') }}" class="form-horizontal" enctype="multipart/form-data" method="post">
                    @csrf

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
                                                                required>
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
                                                            <textarea class="form-control" name="description" id="editor1"></textarea>

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
                                                    data-bs-target="#panelsStayOpen-collapseOnel" aria-expanded="true"
                                                    aria-controls="panelsStayOpen-collapseOnel">
                                                    Groups
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseOnel"
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
                                                                        <span><input
                                                                                class="talents_id md-checkbox form-check float-start mx-1"
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
                                                                <label for="users" class="form-label">Selected
                                                                    Groups</label>
                                                                <select name="groupids[]" id=""
                                                                    class="form-control" multiple>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @error('groupids')
                                                        <label id="groupids-error" class="error text-danger"
                                                            for="groupids">{{ $message }}</label>
                                                    @enderror
                                                    <div id="namehelp" class="form-text">
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                    aria-labelledby="pills-contact-tab" tabindex="0">
                                    <p>For Rights First Create Role Then Edit role</p>


                                    {{-- <div class="accordion" id="accordionPanelsStayOpenExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-collapseOnem" aria-expanded="true"
                                                    aria-controls="panelsStayOpen-collapseOnem">
                                                    Rights
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseOnem"
                                                class="accordion-collapse collapse show">
                                                <div class="accordion-body">



                                                    <div class="table-responsive">
                                                        <table
                                                            class="table text-start align-middle table-bordered table-hover mb-0">
                                                            <thead>
                                                                <tr class="text-dark">
                                                                    <th scope="col">Application Name</th>
                                                            
                                                                    <th scope="col">Create</th>
                                                                    <th scope="col">Read</th>
                                                                    <th scope="col">Update</th>
                                                                    <th scope="col">Delete</th>
                                                              
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($applications as $item)
                                                       
                                                                    <tr>
                                                                        <td>
                                                                            <a href="#">
                                                                                {{ $item->name }}</a>

                                                                        </td>
                                                                        <td>
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="flexSwitchCheckDefault">
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="flexSwitchCheckDefault">
                                                                            </div>
                                                                        </td>
                                                                        <td>

                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="flexSwitchCheckDefault">
                                                                            </div>
                                                                        </td>

                                                                        <td>

                                                                            <div class="form-check form-switch">
                                                                                <input class="form-check-input"
                                                                                    type="checkbox"
                                                                                    id="flexSwitchCheckDefault">
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>

                            <input type="hidden" value="{{ auth()->id() }}" name="created_by">

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
    </script>
@endsection
