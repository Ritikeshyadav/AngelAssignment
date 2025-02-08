<x-app-layout>
    <style>
        .container {
    position: relative;  /* Needed for absolute positioning */
    /* height: 200px;  Example height */
    border: 1px solid #ddd;
}

.btn {
    position: absolute;
    bottom: 0;
    margin-bottom: 20px;
    right: 0; /* Aligns to bottom-right */
}

        </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <a href="{{route('student.add.view')}}"><button class="btn btn-primary">Add</button></a>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __("You're logged in!") }} --}}
                    <table class="table" id="studentTable">
                        <thead>
                          <tr>
                            <th scope="col">Sr No</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Teacher</th>
                            <th scope="col">Class</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$student->student_name}}</td>
                                    <td>{{$student->teacher->name}}</td>
                                    <td>{{$student->class}}</td>
                                    <td>
                                        <a href="{{route('student.edit',['id'=>$student->id])}}">Edit</a>&nbsp;&nbsp;&nbsp;
                                        <a href="{{route('student.delete',['id'=>$student->id])}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    @section('scripts')
    <script>
        $(document).ready(function(){
            $('#studentTable').DataTable();
        });
    </script>
    @endsection
</x-app-layout>
