<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($unit) ? $unit->name : old('name') }}" placeholder="{{ __('Name') }}" required />
            @error('name')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="{{ __('Description') }}" required>{{ isset($unit) ? $unit->description : old('description') }}</textarea>
            @error('description')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="expected">{{ __('Expected') }}</label>
            <input type="time" name="expected" id="expected" class="form-control @error('expected') is-invalid @enderror" value="{{ isset($unit) && $unit->expected ? $unit->expected->format('H:i') : old('expected') }}" placeholder="{{ __('Expected') }}" required />
            @error('expected')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="subject-id">{{ __('Subject') }}</label>
            <select class="form-select @error('subject_id') is-invalid @enderror" name="subject_id" id="subject-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select subject') }} --</option>
                
                        @foreach ($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ isset($unit) && $unit->subject_id == $subject->id ? 'selected' : (old('subject_id') == $subject->id ? 'selected' : '') }}>
                                {{ $subject->name }}
                            </option>
                        @endforeach
            </select>
            @error('subject_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>