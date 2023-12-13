@extends('layouts.kaze')

@section('content')
            <!-- ここがメインコンテンツです -->
           <table border="0" width="580" cellpadding="0" cellspacing="0">
              <tr>
                <td>
                  <!-- 「風のたより年ごとリスト掲載」 -->
        <!--          <div class="container">-->
        <!--<hr color="#c0c0c0">-->
        <div class="row">
           <h2>風のたより一覧</h2>
            @foreach($kaze_list as $kaze)
            <div class="title">
                <h4><a href="{{ route('kaze.index', ['year' => $kaze->year]) }}">■{{ $kaze->year }}年</a></h4>
            </div>
            @endforeach
            
                        
            <hr color="#c0c0c0">
               
        </div>
    </div>
    </div>
@endsection
