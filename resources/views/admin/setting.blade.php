@extends('layouts.admin')

@section('content')
    <div class="container">
        <form action="{{ route('admin.setting.store')}}" method="POST">
            {{csrf_field()}}
            <div class="form-group">
                <label for="">Url callback для Telegram</label>
                <div class="input-group ">
                    <div class="input-group-btn dropdown">
                    <button  type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Действие
                        <span class="caret"></span>
                        <div class="dropdown-menu">

                            <a class="dropdown-item" href="#" onclick="document.getElementById('url_callback_bot').value = '{{url('')}}'">
                                Вставить URL
                            </a>

                            <a href="#" class="dropdown-item">
                                Отправить url
                            </a>


                            <a href="#" class="dropdown-item">
                                Получить информацию
                            </a>
                    </div>
                    </button>
                    </div>
                    <input type="url" class="form-control" id="url_callback_bot" name="url_callback_bot" value="{{ isset($url_callback_bot) ? $url_callback_bot :  '' }}">
                </div>
            </div>
            <button class="btn btn-dark" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
