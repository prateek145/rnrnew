@extends('backend.layouts.app')
@section('content')
    <!-- Recent Sales Start -->
    <div class="container-fluid pt-4x px-4x p-0">
        <div class="bg-light text-start rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Create Report</h6>
                <a href="{{ route('report.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Return</a>

            </div>
            <div class="bg-light rounded h-100 p-0">

                <div class="accordion" id="accordionPanelsStayOpenExample">

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseTwo">
                                Applications
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <form action="{{route('chart.result')}}" method="POST">
                                    @csrf
                                    <div class="mb-3 row">
                                        <div class="col-md-5">
                                            <label for="">Fields</label>
                                            <select name="" class="form-control"
                                                onclick="specificsearch(this.value);" id="" multiple>
                                                @foreach ($fields as $item)
                                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-7">
                                            <label for="">Selection</label>
                                            <div class="specificontainer">

                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <input type="hidden" name="applicationid" value="{{$application->id}}">
                                    <input type="hidden" name="search" value="chart">
                                    <input type="submit" class="btn btn-sm btn-primary pull-right" value="search">
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseOne">
                                Filters
                            </button>
                        </h2>
                        <form action="{{route('filter.result')}}" method="POST">
                            @csrf
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="d-flex justify-content-between">
                                        <label for=""> </label>
                                        <input type="button" onclick="replicatefilter()" value="add more"
                                            class="btn btn-sm btn-primary">
    
                                    </div>
    
                                    <div class="maincontainer mt-5">
                                        <div class="row filtercontainer">
                                            <div class="col-md-3">
                                                <label for=""><strong> Field to Evaluate</strong></label>
                                                <select name="filter[]" id="" class="form-control">
                                                    <option value="">select</option>
                                                    @foreach ($fields as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
    
                                            <div class="col-md-3">
                                                <label for=""><strong>Operators</strong></label>
                                                <select name="operators[]" id="" class="form-control" required>
                                                    <option value="">select</option>
                                                    <option value="contain">Contain</option>
                                                    <option value="notcontain">Not Contain</option>
                                                    <option value="equal">Equal</option>
                                                    <option value="notequal">Not Equal</option>
    
                                                </select>
                                            </div>
    
                                            <div class="col-md-3">
                                                <label for=""><strong>Values</strong></label>
                                                <input type="text" class="form-control" name="values[]" required>
                                            </div>
    
                                            <div class="col-md-2">
                                                <label for=""><strong>Relationship</strong></label>
                                                <p class=""> <strong>AND</strong> </p>
                                            </div>
    
                                            <div class="col-md-1">
                                                <label for=""><strong>Action</strong></label>
                                                <input type="button" id="first" class="btn btn-sm btn-danger clonebtnx"
                                                    onclick="removefilter(this.id);" value="X">
                                            </div>
    
                                        </div>
    
                                    </div>
    
                                    <input type="hidden" name="search" value="filter">
                                    <input type="hidden" name="applicationid" value="{{$application->id}}">
    
                                    <input type="submit"  value="search" class="btn btn-sm btn-primary mt-5">
                                </div>
                            </div>

                        </form>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                Sorting
                            </button>
                        </h2>

                        <form action="{{route('sorting.result')}}" method="POST">
                            @csrf
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <div class="mb-3 row">
                                        <div class="col-md-12">
                                            {{-- <label for="">Sorting</label> --}}
                                            <select name="sorting" class="form-control " id="">
                                                <option value="">Select</option>
                                                @foreach ($fields as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="applicationid" value="{{$application->id}}">
                                    <input type="hidden" name="search" value="sorting">
                                    <input type="submit" value="search" class="btn btn-sm btn-primary">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Recent Sales End -->
    <script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
    <script>
        // CKEDITOR.replace('editor1');

        function replicatefilter() {
            var mcontainer = document.getElementsByClassName('maincontainer')[0];
            var fcontainer = document.getElementsByClassName('filtercontainer')[0];
            var clonenode = fcontainer.cloneNode(true);
            mcontainer.appendChild(clonenode);
            // console.log(clonenode);

            var clonebtnx = document.getElementsByClassName('clonebtnx');
            if (clonebtnx.length > 1) {
                document.getElementsByClassName('clonebtnx')[clonebtnx.length - 1].id = 'cls' + (clonebtnx.length - 1);
                // console.log();
                // clonebtnx[clonebtnx.length].id = clonebtnx.length;
            }
        }

        function removefilter(value) {
            if (value != 'first') {
                var clsbtn = document.getElementById(value);
                var string = value.replace('cls', '');
                var mcontainer = document.getElementsByClassName('maincontainer')[0];
                var fcontainer = document.getElementsByClassName('filtercontainer')[string];
                mcontainer.removeChild(fcontainer);
            } else {
                alert('Irremovable');
            }
        }

        function specificsearch(fieldname) {
            // console.log(name);
            var specific1 = document.getElementsByClassName('specific')[0];
            // console.log(specific1);
            if (specific1 != undefined) {
                var clone = document.getElementsByClassName('specific')[0].cloneNode(true);
                var specificontainer = document.getElementsByClassName('specificontainer')[0];

                var fieldnamec = document.getElementById(fieldname);
                if (fieldnamec) {
                    alert('Already Added Field.')
                } else {
                    specificontainer.appendChild(clone);
                    var specific = document.getElementsByClassName('specific');
                    var fieldname1 = document.getElementsByClassName('fieldinput')[document.getElementsByClassName(
                        'fieldinput').length - 1];
                    fieldname1.value = fieldname;
                    fieldname1.id = fieldname;
                    if (specific.length > 1) {
                        specific[specific.length - 1].id = 'specific' + (specific.length - 1);

                    }

                }
            } else {
                var specificcontainer = document.getElementsByClassName('specificontainer')[0];
                var specific = document.createElement('div');
                specific.className = 'row specific';
                //for group by and count of 
                var div = document.createElement('div');
                div.className = 'col-md-4';

                var select = document.createElement('select');
                select.className = 'form-control';
                select.name = 'select[]';

                var option = document.createElement('option');
                option.value = 'groupby';
                option.innerText = 'Group By';

                var option1 = document.createElement('option');
                option1.value = 'countof';
                option1.innerText = 'Count Of';

                select.appendChild(option);
                select.appendChild(option1);
                div.appendChild(select);
                specific.appendChild(div);

                //for field name
                var div1 = document.createElement('div');
                div1.className = 'col-md-7';

                var input1 = document.createElement('input');
                var specificclass = 'fieldname' + (document.getElementsByClassName('specific').length);
                input1.id = fieldname;
                input1.value = fieldname;
                input1.readOnly = true;
                input1.className = 'form-control fieldinput';
                input1.name = 'fieldname[]';

                div1.appendChild(input1);
                specific.appendChild(div1);

                //for cross field 
                var div2 = document.createElement('div');
                div2.className = 'col-md-1';

                var button = document.createElement('input');
                button.type = 'button';
                // console.log(document.getElementsByClassName('specific').length);
                button.id = 'specific' + (document.getElementsByClassName('specific').length);
                button.className = 'btn btn-sm btn-danger closespecificbtn';
                button.value = 'X';
                button.setAttribute('onclick', 'removespecificfilter(this.id)');

                div2.appendChild(button);
                specific.appendChild(div2);
                specificcontainer.appendChild(specific);

            }
        }

        function removespecificfilter(value) {
            var clsbtn = document.getElementById(value);
            var string = value.replace('specific', '');
            var mcontainer = document.getElementsByClassName('specificontainer')[0];
            var fcontainer = document.getElementsByClassName('specific')[string];
            mcontainer.removeChild(fcontainer);

        }
    </script>
@endsection
