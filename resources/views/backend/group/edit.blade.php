@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4x px-4x p-0">
        <div class="bg-light text-start rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Edit Group</h6>
                <a href="{{ route('group.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Return</a>
            </div>
            <div class="bg-light rounded h-100 p-0">
                
                <form action="{{ route('group.update', $group->id) }}" class="form-horizontal" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('put')

                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Group Information
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                <div class="row">    
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Name</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            name="name" id="name" aria-describedby="namehelp"
                                            value="{{ $group->name }}" required>
                                        @error('name')
                                            <label id="name-error" class="error text-danger"
                                                for="name">{{ $message }}</label>
                                        @enderror
                                        <div id="namehelp" class="form-text">
                                        </div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="exampleInputEmail1" class="form-label">Status</label>
                                        <select name="status" id=""
                                            class="form-control @error('status') is-invalid @enderror">
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
                                    <div class="mb-3  col-12">
                                        <label for="exampleInputEmail1"
                                            class="form-label @error('description') is-invalid @enderror">Description</label>
                                        <textarea class="form-control" name="description" id="editor1">{{ $group->description }}</textarea>

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
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Member
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="mb-3 row">
                                        <div class="col-md-12">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 text-start">
                                                        <label for="filter" class="form-label">Users&nbsp;</label><input id="filter"
                                                            type="text" class="filter form-control"
                                                            placeholder="Search Groups">
                                                        <br />

                                                        <div id="mdi" style="max-height: 10%; overflow:auto;">
                                                            @foreach ($users as $item)
                                                                @if (in_array($item->id, json_decode($group->userids)))
                                                                    <span>
                                                                        <input class="talents_id md-checkbox form-check float-start mx-1"
                                                                            onchange="dragdrop(this.value, this.id, 'userids[]');"
                                                                            type="checkbox"
                                                                            id="{{ $item->name . $item->lastname }}"
                                                                            value="{{ $item->id }}" checked>{{ $item->name . ' ' . $item->lastname }}

                                                                    </span><br>
                                                                @else
                                                                    <span>
                                                                        <input class="talents_id md-checkbox form-check float-start mx-1"
                                                                            onchange="dragdrop(this.value, this.id, 'userids[]');"
                                                                            type="checkbox"
                                                                            id="{{ $item->name . $item->lastname }}"
                                                                            value="{{ $item->id }}">{{ $item->name . ' ' . $item->lastname }}

                                                                    </span><br>
                                                                @endif
                                                            @endforeach
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="users" class="form-label">Selected Users</label>
                                                        @php
                                                            $userids = json_decode($group->userids);
                                                            $susers = App\Models\User::find($userids);

                                                            if ($susers) {
                                                                # code...
                                                            } else {
                                                                # code...
                                                                $susers = [];
                                                            }
                                                            
                                                        @endphp
                                                        <select name="userids[]" id="" class="form-control" multiple>
                                                            @foreach ($susers as $item)
                                                            <option value="{{$item->id}}" id="{{$item->name}}" selected>{{ $item->name . ' ' . $item->lastname }}</option>
                                                                
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('users')
                                                <label id="users-error" class="error text-danger"
                                                    for="users">{{ $message }}</label>
                                            @enderror
                                            <div id="namehelp" class="form-text">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="mb-3 row">
                                        <div class="col-md-12">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 text-start">
                                                        <label for="filter" class="form-label">Groups&nbsp;</label><input id="filter"
                                                            type="text" class="filter form-control"
                                                            placeholder="Search Groups">
                                                        <br />

                                                        <div id="mdi" style="max-height: 10%; overflow:auto;">
                                                            @foreach ($groups as $item)
                                                            {{-- {{dd($item, $group->groupids)}} --}}
                                                            @if ($group->groupids != null && in_array($item->id, json_decode($group->groupids)))
                                                            <span><input class="talents_id md-checkbox form-check float-start mx-1"
                                                                onchange="dragdrop(this.value, this.id, 'groupids[]');"
                                                                type="checkbox"
                                                                id="{{ $item->name}}"
                                                                value="{{ $item->id }}" checked>{{ $item->name}}</span><br>  
                                                            @else
                                                            <span><input class="talents_id md-checkbox form-check float-start mx-1"
                                                                onchange="dragdrop(this.value, this.id, 'groupids[]');"
                                                                type="checkbox"
                                                                id="{{ $item->name}}"
                                                                value="{{ $item->id }}">{{ $item->name}}</span><br>
                                                            @endif

                                                            @endforeach
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="users" class="form-label">Selected Groups</label>
                                                        @php
                                                        $groupids = json_decode($group->groupids);
                                                        $groups1 = App\Models\backend\Group::find($groupids);
                                                        if ($groups1) {
                                                            # code...
                                                            
                                                        } else {
                                                            # code...
                                                            $groups1 = [];

                                                        }
                                                        
                                                        // dd($groups1);
                                                        @endphp
                                                        <select name="groupids[]" id="" class="form-control"
                                                            multiple>
                                                            @foreach ($groups1 as $item)
                                                    
                                                            <option value="{{$item->id}}" id="{{$item->name}}" selected>{{ $item->name }}</option>
                                                                
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


                        {{-- <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseThree">
                                    Member of
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="mb-3 row">
                                        <div class="col-md-12">

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3 text-start">
                                                        <label for="filter">Groups&nbsp;</label><input id="filter"
                                                            type="text" class="filter form-control"
                                                            placeholder="Search Groups">
                                                        <br />

                                                        <div id="mdi" style="max-height: 10%; overflow:auto;">
                                                            @foreach ($groups as $item)

                                                                @if ($group->mouserids != null && in_array($item->id, json_decode($group->mouserids)))
                                                                <span><input class="talents_id md-checkbox form-check float-start mx-1"
                                                                    onchange="dragdrop(this.value, this.id, 'mogroupids[]');"
                                                                    type="checkbox"
                                                                    id="{{ 'mogroupids'. $item->id }}"
                                                                    value="{{ $item->id }}" checked>{{ $item->name . ' ' . $item->lastname }}</span><br>
                                                                @else
                                                                <span><input class="talents_id md-checkbox form-check float-start mx-1"
                                                                    onchange="dragdrop(this.value, this.id, 'mogroupids[]');"
                                                                    type="checkbox"
                                                                    id="{{ 'mogroupids'. $item->id }}"
                                                                    value="{{ $item->id }}">{{ $item->name . ' ' . $item->lastname }}</span><br>
                                                                @endif

                                                            @endforeach
                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="users">Selected Groups</label>
                                                        @php
                                                        $mogroupids = json_decode($group->mogroupids);
                                                        $groups2 = App\Models\backend\Group::find($mogroupids);

                                                        if ($groups2) {
                                                            # code...
                                                            
                                                        } else {
                                                            # code...
                                                            $groups2 = [];

                                                        }
                                                        
                                                        // dd($groups1);
                                                        @endphp
                                                        <select name="mogroupids[]" id="" class="form-control"
                                                            multiple>
                                                            @foreach ($groups2 as $item)
                                                    
                                                            <option value="{{$item->id}}" id="{{'mogroupids'.$item->id}}">{{ $item->name . ' ' . $item->lastname }}</option>
                                                                
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('mogroup_id')
                                                <label id="mogroup_id-error" class="error text-danger"
                                                    for="mogroup_id">{{ $message }}</label>
                                            @enderror
                                            <div id="namehelp" class="form-text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>


                    <input type="hidden" value="{{ auth()->id() }}" name="created_by">

                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
    </script>

    <script>
        var status = "{{ $group->status }}";
        var currentstatus = document.getElementsByName('status')[0];
        for (let index = 0; index < currentstatus.length; index++) {
            if (currentstatus[index].value == status) {
                currentstatus[index].selected = true;
            }
        }

        // const filterEl = document.querySelector('#filter');
        // const els = Array.from(document.querySelectorAll('#mdi > span'));
        // const labels = els.map(el => el.textContent);
        // const handler = value => {
        //     const matching = labels.map((label, idx, arr) => label.toLowerCase().includes(value.toLowerCase()) ? idx :
        //         null).filter(el => el != null);

        //     els.forEach((el, idx) => {
        //         if (matching.includes(idx)) {
        //             els[idx].style.display = 'block';
        //         } else {
        //             els[idx].style.display = 'none';
        //         }
        //     });
        // };

        // filterEl.addEventListener('keyup', () => handler.call(null, filterEl.value));


        // function dragdrop(value, name) {
        //     // console.log(value);
        //     if (document.getElementById(name).checked) {
        //         var userselect = document.getElementsByName('userids[]')[0];
        //         var option = document.createElement('option');
        //         option.value = value;
        //         option.id = value;
        //         option.innerText = name;
        //         option.selected = true;
        //         userselect.appendChild(option);
        //     } else {
        //         var userselect = document.getElementsByName('userids[]')[0];
        //         var removeoption = document.getElementById(value);
        //         userselect.removeChild(removeoption);
        //     }
        // }
    </script>
@endsection
