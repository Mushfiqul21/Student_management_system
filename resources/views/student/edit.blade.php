<div class="modal-header border-0">
    <h5 class="modal-title">Edit Student</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <form action="{{ route('student.update', encrypt($student->id)) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" value="{{ $student?->name }}"
                   class="form-control @error('name') is-invalid @enderror" id="name" autofocus>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Image Field -->
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                   id="image">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Class Field -->
        <div class="mb-3">
            <label for="class" class="form-label">Class</label>
            <select class="form-select @error('class') is-invalid @enderror" name="class" id="class">
                <option value="3" {{ $student?->class == 3 ? 'selected' : '' }}>3</option>
                <option value="4" {{ $student?->class == 4 ? 'selected' : '' }}>4</option>
                <option value="5" {{ $student?->class == 5 ? 'selected' : '' }}>5</option>
                <option value="6" {{ $student?->class == 6 ? 'selected' : '' }}>6</option>
                <option value="7" {{ $student?->class == 7 ? 'selected' : '' }}>7</option>
                <option value="8" {{ $student?->class == 8 ? 'selected' : '' }}>8</option>
                <option value="9" {{ $student?->class == 9 ? 'selected' : '' }}>9</option>
                <option value="10" {{ $student?->class == 10 ? 'selected' : '' }}>10</option>
            </select>
            @error('class')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- phone Field -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="number" name="phone" value="{{ $student?->phone }}" class="form-control @error('phone') is-invalid @enderror" id="phone">
            @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Address Field -->
        <div class="mb-3">
            <label for="userAddress" class="form-label">Address</label>
            <input type="text" name="address" value="{{ $student?->address }}" class="form-control @error('address') is-invalid @enderror" id="userAddress">
            @error('address')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Date of Birth Field -->
        <div class="mb-3">
            <label for="userDob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" value="{{ $student?->dob }}"
                   class="form-control @error('dob') is-invalid @enderror" id="userDob">
            @error('dob')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Gender Field -->
        <div class="row form-group mb-3">
            <div class="col-6">
                <label for="gender" class="mb-2 form-label">Gender</label>
                <div class="d-flex">
                    <div class="mx-1 d-flex">
                        <input type="radio" name="gender" value="Male" id="gender_male" class="mr-5" {{ $student->gender == "Male" ? 'checked' : '' }}>
                        <label for="gender_male" class="mr-5 px-1">Male</label>
                    </div>
                    <div class="mx-1 d-flex">
                        <input type="radio" name="gender" value="Female" id="gender_female" class="mr-5 px-1" {{ $student->gender == "Female" ? 'checked' : '' }}>
                        <label for="gender_female" class="mr-5 px-1">Female</label>
                    </div>
                    <div class="mx-1 d-flex">
                        <input type="radio" name="gender" value="Others" id="gender_others" class="mr-5 px-1" {{ $student->gender == "Others" ? 'checked' : '' }}>
                        <label for="gender_others" class="mr-5 px-1">Others</label>
                    </div>
                </div>
                @error('gender')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <!--Guardian Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Guardian Name</label>
            <input type="text" name="guardian_name" value="{{ $student?->guardian_name }}" class="form-control @error('name') is-invalid @enderror" id="name" autofocus>
            @error('guardian_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!--Guardian phone Field -->
        <div class="mb-3">
            <label for="phone" class="form-label">Guardian Phone</label>
            <input type="number" name="guardian_phone" value="{{ $student?->guardian_phone }}" class="form-control @error('phone') is-invalid @enderror" id="phone">
            @error('guardian_phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer border-0">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark px-5">Update</button>
        </div>
    </form>
</div>


