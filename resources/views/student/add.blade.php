<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="addForm" method="POST">
                        @method('POST')
                        @csrf
                        <div class="form-group" style="margin-bottom:25px;">
                        <label for="exampleInputEmail1">Student Name</label>
                        <input type="text" class="form-control" id="student_name" name="student_name"  aria-describedby="emailHelp" placeholder="Enter student name">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        </div>
                        <div class="form-group" style="margin-bottom:25px;">
                        <label for="exampleInputPassword1">Class Teacher</label>
                        <select class="form-control" name="teacher" id="teacher" >
                            <option>Select Class Teacher</option>
                            @foreach ($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group" style="margin-bottom:25px;">
                        <label for="exampleInputPassword1">Class</label>
                        <input type="text" class="form-control" id="class" name="class"  placeholder="Enter class">
                        </div>
                        <div class="form-group" style="margin-bottom:25px;">
                            <label for="exampleInputPassword1">Yearly Fees</label>
                            <input type="number" class="form-control" id="yearly_fees" name="yearly_fees"  placeholder="Enter Yearly Fees">
                        </div>
                        <div class="form-group" style="margin-bottom:25px; width: 162px;">
                        <label for="exampleInputPassword1">Admission Date</label>
                        <input type="date" class="form-control" id="admission_date" name="admission_date"  placeholder="Password">
                        </div>
                        {{-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')
    <script>
        $(document).ready(function () {
            $("#addForm").validate({
                rules: {
                    student_name: {
                        required: true,
                        // minlength: 3
                    },
                    teacher: {
                        required: true,
                        // email: true
                    },
                    class: {
                        required: true,
                        // minlength: 6
                    },
                    yearly_fees: {
                        required: true,
                        // minlength: 6
                    },
                    admission_date: {
                        required: true,
                        // minlength: 6
                    },
                },
                messages: {
                    student_name: {
                        required: "Please enter student name",
                        // minlength: "Name must be at least 3 characters"
                    },
                    teacher: {
                        required: "Please select teacher",
                        // minlength: "Name must be at least 3 characters"
                    },
                    class: {
                        required: "Please enter class",
                        // minlength: "Name must be at least 3 characters"
                    },
                    yearly_fees: {
                        required: "Please enter yearly fees",
                        // minlength: "Name must be at least 3 characters"
                    },
                    admission_date: {
                        required: "Please select admission date",
                        // minlength: "Name must be at least 3 characters"
                    },
                },
                submitHandler: function (form) {
                    // alert("Form submitted successfully!");
                    // form.submit();
                    var formData = new FormData(form);
                    $.ajax({
                        url: "{{route('student.add')}}",
                        type: 'post',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response)
                        {
                            if(response.status_code == 200)
                            {
                                toastr.success(response.message);
                                setTimeout(function () {
                                    window.location.href = "{{route('dashboard')}}";
                                }, 3000);

                            }
                            if(response.status_code == 422)
                            {
                                toastr.warning(response.message);
                            }
                        }
                    })
                }
            });
        });
    </script>
    
    @endsection
</x-app-layout>