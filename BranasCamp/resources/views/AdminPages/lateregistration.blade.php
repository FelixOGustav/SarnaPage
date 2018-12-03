@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
    <div class="sidescrollcontent">
        <h2>Oanvända länkar</h2>
        <p>Kopiera och skicka länk till den som ska anmäla sig sent</p>
        <table class="table">
            <tbody>
                @foreach($links as $link)
                    <tr>
                        <td>
                            @if($link->leader == 1)
                                <p>Ledare</p>
                            @else
                                <p>Delagare</p>
                            @endif
                        </td>
                        <td>
                            <p id="customlink{{$link->id}}" >{{$link->link}}</p>
                        </td>
                        <td>
                            <button onclick="copyToClipboard('#customlink{{$link->id}}')" class="btn button-green">Kopiera</button>
                        </td>
                        <td>
                            <a href="/admin/lateregistration/remove/{{$link->id}}" class="btn btn-danger">Ta bort</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="panel"style="width: 400px;">
    <h1>Lägg Till ny länk</h1>
    <p>Skriv ett meddelande i rutan. Den fungerar som nyckel och kommer synas i länken. Skriv något roligt.<br>
    OBS!!! Inga mellanslag</p>
    <div class="sidescrollcontent">
        
        <form method="POST" action="/admin/addlateregistration">
            {{ csrf_field() }}
            <div class="col">
                <div class="row">
                    <span style="width: 100%;">
                        <label for="message">Länk</label>
                        <input type="text" name="message" id="message" required style="width: 80%;">
                    </span>
                </div>
                <div class="row">
                    <span style="width: 100%;">
                        <label for="leader">Länk för ledare</label>
                        <input type="checkbox" name="leader" id="leader" value="1">
                    </span>
                </div>
                <div class="row">
                    <button type="submit" class="buttonStyle">
                        <p style="font-size: 25px;">Lägg till</p>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function CopyLink(id) {
        
        var copyText = document.getElementById(String(id));
        copyText.select();
        document.execCommand("copy");
    }

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>

@endsection