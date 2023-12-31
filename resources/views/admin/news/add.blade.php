<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>新着記事作成</title>
    </head>
    <body>
        <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>新着記事新規作成</h2>
                <form action="{{ route('admin.news.add') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">ナンバー年</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="year" value="{{ old('year') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">ナンバー月</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="month" value="{{ old('month') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div>
    </body>
</html>

