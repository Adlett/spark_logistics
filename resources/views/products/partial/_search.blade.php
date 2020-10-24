<form action="{{ route('admin.member.index') }}">
    <div class="form-group">
        <label for="member-fio" class="control-label">ФИО</label>
        <input type="text" id="member-fio" class="form-control input-sm" value="{{request('fio')}}" name="fio" />
    </div>
    <div class="form-group">
        <label for="member-position" class="control-label">Должность</label>
        <input type="text" id="member-position" class="form-control input-sm" value="{{request('position')}}" name="position" />
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-sm btn-default">
            <i class="fa fa-search"></i> Поиск
        </button>
    </div>
</form>