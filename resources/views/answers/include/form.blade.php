<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" value="{{ isset($answer) ? $answer->description : old('description') }}" placeholder="{{ __('Description') }}" required />
            @error('description')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="is-correct">{{ __('Is Correct') }}</label>
            <input type="number" name="is_correct" id="is-correct" class="form-control @error('is_correct') is-invalid @enderror" value="{{ isset($answer) ? $answer->is_correct : old('is_correct') }}" placeholder="{{ __('Is Correct') }}" required />
            @error('is_correct')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="question-id">{{ __('Question') }}</label>
            <select class="form-select @error('question_id') is-invalid @enderror" name="question_id" id="question-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select question') }} --</option>
                
                        @foreach ($questions as $question)
                            <option value="{{ $question->id }}" {{ isset($answer) && $answer->question_id == $question->id ? 'selected' : (old('question_id') == $question->id ? 'selected' : '') }}>
                                {{ $question->question }}
                            </option>
                        @endforeach
            </select>
            @error('question_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
</div>