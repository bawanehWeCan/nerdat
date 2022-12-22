<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="lname">{{ __('Lname') }}</label>
            <input type="text" name="lname" id="lname" class="form-control @error('lname') is-invalid @enderror" value="{{ isset($profile) ? $profile->lname : old('lname') }}" placeholder="{{ __('Lname') }}" required />
            @error('lname')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone">{{ __('Phone') }}</label>
            <input type="tel" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ isset($profile) ? $profile->phone : old('phone') }}" placeholder="{{ __('Phone') }}" required />
            @error('phone')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="gender">{{ __('Gender') }}</label>
            <input type="text" name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" value="{{ isset($profile) ? $profile->gender : old('gender') }}" placeholder="{{ __('Gender') }}" required />
            @error('gender')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="classroom-id">{{ __('Classroom') }}</label>
            <select class="form-select @error('classroom_id') is-invalid @enderror" name="classroom_id" id="classroom-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select classroom') }} --</option>
                
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" {{ isset($profile) && $profile->classroom_id == $classroom->id ? 'selected' : (old('classroom_id') == $classroom->id ? 'selected' : '') }}>
                                {{ $classroom->name }}
                            </option>
                        @endforeach
            </select>
            @error('classroom_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="school-grade-id">{{ __('School Grade') }}</label>
            <select class="form-select @error('school_grade_id') is-invalid @enderror" name="school_grade_id" id="school-grade-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select school grade') }} --</option>
                
                        @foreach ($schoolGrades as $schoolGrade)
                            <option value="{{ $schoolGrade->id }}" {{ isset($profile) && $profile->school_grade_id == $schoolGrade->id ? 'selected' : (old('school_grade_id') == $schoolGrade->id ? 'selected' : '') }}>
                                {{ $schoolGrade->name }}
                            </option>
                        @endforeach
            </select>
            @error('school_grade_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="user-id">{{ __('User') }}</label>
            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select user') }} --</option>
                
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ isset($profile) && $profile->user_id == $user->id ? 'selected' : (old('user_id') == $user->id ? 'selected' : '') }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
            </select>
            @error('user_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>