<div class="mb-2">
    <select name="ex_id" id="ex_id" class="form-select" aria-label="Default select example" onchange="">
        @foreach($exercises as $exercise)
            <option value="{{ $exercise->ex_id }}" data-extype="{{ $exercise->ex_type }}" @if ((old('ex_id') == $exercise->ex_id)or((isset($workout) and ($workout->ex_id == $exercise->ex_id)))) selected="selected" @endif>
                {{ $exercise->ex_descr }}
            </option>
        @endforeach
    </select>
    <div id="ex_id_help" class="form-text">Выберите упражнение</div>
</div>
<div class="mb-2">
    <label for="count1">{{ __('wmessages.CountOne') }}</label>
    <input name="count1" required  type="number" min="0" class="form-control" id="count1" aria-describedby="count1_help" value="{{ old('count1') ?? $workout->count1 ?? '0'}}">
    <div id="count1_help" class="form-text">Enter count of repeats 1</div>
</div>
<div class="mb-2" id="divWeight1">
    <label for="weight1">{{ __('wmessages.WeightOne') }}</label>
    <input name="weight1" required  type="number" min="0"  step="0.1" class="form-control" id="weight1" aria-describedby="weight1_help" value="{{ old('weight1') ?? $workout->weight1 ?? '0'}}">
    <div id="weight1_help" class="form-text">Enter count of repeats 1</div>
</div>
<div class="mb-2" id="divCount2">
    <label for="count2">{{ __('wmessages.CountTwo') }}</label>
    <input name="count2" required  type="number" min="0" class="form-control" id="count2" aria-describedby="count2_help" value="{{ old('count2') ?? $workout->count2 ?? '0'}}">
    <div id="count2_help" class="form-text">Enter count of repeats 1</div>
</div>
<div class="mb-2" id="divWeight2">
    <label for="weight2">{{ __('wmessages.WeightTwo') }}</label>
    <input name="weight2" required  type="number" min="0" step="0.1" class="form-control" id="weight2" aria-describedby="weight2_help" value="{{ old('weight2') ?? $workout->weight2 ?? '0'}}">
    <div id="weight2_help" class="form-text">Enter count of repeats 1</div>
</div>
