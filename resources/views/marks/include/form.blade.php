<div class="row mb-2">
    <div class="col-md-6">
        <div class="form-group">
            <label for="is-correct">{{ __('Is Correct') }}</label>
            <input type="number" name="is_correct" id="is-correct" class="form-control @error('is_correct') is-invalid @enderror" value="{{ isset($mark) ? $mark->is_correct : old('is_correct') }}" placeholder="{{ __('Is Correct') }}" required />
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
                            <option value="{{ $question->id }}" {{ isset($mark) && $mark->question_id == $question->id ? 'selected' : (old('question_id') == $question->id ? 'selected' : '') }}>
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
    <div class="col-md-6">
        <div class="form-group">
            <label for="answer-id">{{ __('Answer') }}</label>
            <select class="form-select @error('answer_id') is-invalid @enderror" name="answer_id" id="answer-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select answer') }} --</option>
                
                        @foreach ($answers as $answer)
                            <option value="{{ $answer->id }}" {{ isset($mark) && $mark->answer_id == $answer->id ? 'selected' : (old('answer_id') == $answer->id ? 'selected' : '') }}>
                                {{ $answer->description }}
                            </option>
                        @endforeach
            </select>
            @error('answer_id')
                <span class="text-danger">
                    {{ $message }}
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="result-id">{{ __('Result') }}</label>
            <select class="form-select @error('result_id') is-invalid @enderror" name="result_id" id="result-id" class="form-control" required>
                <option value="" selected disabled>-- {{ __('Select result') }} --</option>
                
                        @foreach ($results as $result)
                            <option value="{{ $result->id }}" {{ isset($mark) && $mark->result_id == $result->id ? 'selected' : (old('result_id') == $result->id ? 'selected' : '') }}>
                                {{ $result->name }}
                            </option>
                        @endforeach
            </select>
            @error('result_id')
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
                            <option value="{{ $user->id }}" {{ isset($mark) && $mark->user_id == $user->id ? 'selected' : (old('user_id') == $user->id ? 'selected' : '') }}>
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