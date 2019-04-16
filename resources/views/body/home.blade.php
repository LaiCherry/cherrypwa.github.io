@extends('layouts.master')

{{--不同頁面不同title--}}
@section('title', 'Home')

@section('content')
    <div>
        <form class="form-horizontal" method="POST" action="{{ url('/search_user') }}">
            {{ csrf_field() }}
            <select id="user_select" name="user_select" class="select-items" style="width:175px;height:26px;">
                <option value=""></option>
                @if($users != null)
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                @endif
            </select>
            <button type="submit" class="btn btn-primary">查詢</button>
        </form>
        <div style="height:20px;"></div>
        <table>
            <thread>
                <tr>
                    <th>序號</th>
                    <th>標題</th>
                    <th>發佈者</th>
                    <th>發佈時間</th>
                </tr>
            </thread>
            <tbody>
                @if($articles != null)
                    @foreach($articles as $identifier=>$article)
                        <tr>
                            <td>
                                <label>{{ (++$identifier)+ ($articles->perPage() * ($articles->currentPage()-1)) }}</label>
                            </td>
                            <td>
                                <label>{{ $article->title }}</label>
                            </td>
                            <td>
                                <label>{{ $article->user->name }}</label>
                            </td>
                            <td>
                                <label>{{ $article->created_at }}</label>
                            </td>
                        </tr>
                    
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
@endsection