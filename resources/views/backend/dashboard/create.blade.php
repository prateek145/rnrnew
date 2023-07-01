@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4x px-4x p-0">
        <div class="bg-light text-start rounded p-4">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Create Dashboard</h6>
                <a href="{{ route('dashboard.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Return</a>
            </div>
            <div class="bg-light rounded h-100 p-4x">
                <form action="{{ route('dashboard.store') }}" class="form-horizontal" enctype="multipart/form-data" method="post">
                    @csrf

                    <div class="bg-light rounded h-100 p-4x">
                        {{-- <h6 class="mb-4">Audit </h6> --}}
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">General</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">Layout</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-contact" type="button" role="tab"
                                        aria-controls="pills-contact" aria-selected="false">Access</button>
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
                                                    Layout Design
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseOnel"
                                                class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <label for="">Column Layout</label>
                                                    <select name="layout" id="" class="form-control">
                                                        <option value="onecolumn_100" selected>One Column - 100</option>
                                                        <option value="twocolumn_50_50">Two Column - 50/50</option>
                                                        <option value="twocolumn_60_40">Two Column - 60/40</option>
                                                        <option value="twocolumn_40_60">Two Column - 40/60</option>
                                                        <option value="threecolumn_33_34_33">Three Column - 33/34/33
                                                        </option>
                                                        <option value="threecolumn_20_40_40">Three Column - 20/40/40
                                                        </option>
                                                        <option value="threecolumn_40_40_20">Three Column - 40/40/20
                                                        </option>
                                                        <option value="threecolumn_30_40_30">Three Column - 30/40/30
                                                        </option>
                                                        <option value="sixcolumn_16_17_17_17_17_16">Six Column -
                                                            16/17/17/17/17/16</option>
                                                    </select>
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
                                                    data-bs-target="#panelsStayOpen-collapseOnem" aria-expanded="true"
                                                    aria-controls="panelsStayOpen-collapseOnem">
                                                    Rights
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapseOnem"
                                                class="accordion-collapse collapse show">
                                                <div class="accordion-body">

                                                    <input type="radio" name="access"
                                                        onclick="showgroupsname('false')" value="public" checked required>
                                                    <label for="">Public</label><br>

                                                    <div class="row mb-2">
                                                        <div class="col-md-10">
                                                            <input type="radio" onclick="showgroupsname('true')"
                                                                name="access" value="private" required>
                                                            <label for="">Private</label><br>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-12 d-none showaddbtn" style="width: 100%">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3 text-start">
                                                                    <label for="filter">Users&nbsp;</label><input
                                                                        id="filter" type="text"
                                                                        class="filter form-control"
                                                                        placeholder="Search Users">
                                                                    <br />

                                                                    <div id="mdi"
                                                                        style="max-height: 10%; overflow:auto;">
                                                                        @foreach ($users as $item)
                                                                            <span><input class="talents_idmd-checkbox"
                                                                                    onchange="dragdrop(this.value, this.id, 'userids[]');"
                                                                                    type="checkbox"
                                                                                    id="{{ $item->name . ' ' . $item->lastname }}"
                                                                                    value="{{ $item->id }}">{{ $item->name . ' ' . $item->lastname }}</span><br>
                                                                        @endforeach
                                                                    </div>


                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="users">Selected Users</label>
                                                                    <select name="userids[]" id=""
                                                                        class="form-control" multiple>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3 text-start">
                                                                    <label for="filter">Groups&nbsp;</label><input
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
                                                                    <label for="users">Selected Groups</label>
                                                                    <select name="groupids[]" id=""
                                                                        class="form-control" multiple>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" value="{{ auth()->id() }}" name="created_by">

                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');

        function showgroupsname(value) {
            // var groupname = document.getElementsByClassName('groupsname')[0];
            // groupname.className = 'd-block groupsname';

            if (value == 'true') {
                var showaddbtn = document.getElementsByClassName('showaddbtn')[0];
                showaddbtn.className = 'col-md-2 d-block showaddbtn';

            } else {
                var showaddbtn = document.getElementsByClassName('showaddbtn')[0];
                showaddbtn.className = 'col-md-2 d-none showaddbtn';
            }
        }

        //script for js searchname

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
    </script>
@endsection
