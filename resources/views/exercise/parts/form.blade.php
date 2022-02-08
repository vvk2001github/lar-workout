<div class="mb-2">
    <label for="exampleInputEmail1" class="ex_descr">{{ __('exmessages.ExDescr') }}</label>
    <input name="ex_descr" required  type="text" class="form-control" id="ex_descr" aria-describedby="ex_descr_help" value="{{ old('ex_descr') ?? $exercise->ex_descr ?? ''}}">
    <div id="ex_descr_help" class="form-text">Введите название упражнения</div>
</div>
<div class="mb-2">
    <select name="ex_type" id="ex_type" class="form-select" aria-label="Default select example">
        <option value="0" @if (old('ex_type') == '0') selected="selected" @endif>{{ exTypeToString(0) }}</option>
        <option value="1" @if (old('ex_type') == '1') selected="selected" @endif>{{ exTypeToString(1) }}</option>
        <option value="2" @if (old('ex_type') == '2') selected="selected" @endif>{{ exTypeToString(2) }}</option>
        <option value="3" @if (old('ex_type') == '3') selected="selected" @endif>{{ exTypeToString(3) }}</option>
    </select>
    <div id="ex_descr_help" class="form-text">Выберите тип упражнения</div>
</div>
