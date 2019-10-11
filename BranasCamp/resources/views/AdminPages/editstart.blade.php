@extends('Layouts/AdminTemplate')
@section('adminContent')

<div class="panel">
    <div class="sidescrollcontent">
        <h2>Hantera innehållet på startsidan</h2>
        <table style="color: #606569; white-space: normal;" class="table table-hover">
            <thead>
                <th>Titel</th>
                <th>Brödtext</th>
                <th>Typ</th>
                <th>bild</th>
                <th>Redigera</th>
                <th>Radera</th>
            </thead>
            @foreach ($infos as $info)
                <tbody>
                    <tr>
                        <td>{{$info->title}}</td>
                        <td>{{$info->body}}</td>
                        <td>{{$info->type}}</td>
                        <td><img src="{{URL::asset($info->img)}}" style="height: 150px;"></td>
                        <td><a href="/admin/editinfo/{{$info->id}}" class="btn btn-info">Redigera</a></td>
                        <td><a href="/admin/removeinfo/{{$info->id}}" class="btn btn-danger">Ta bort</a></td>
                    </tr>
                </tbody>
            @endforeach
        </table>
        <hr>
        <h2>Ny</h2>
        <form action="/admin/editinfo" method="POST">
            {{ csrf_field() }}
            <div style="color: #606569;">
                <h4>Titel</h4>
                <input type="text" name="title" id="title" style="width: calc(100% - 15px);">
            </div>
            <div style="color: #606569;">
                <h4>Brödtext</h4>
                <textarea type="text" name="body" id="body" style="width: calc(100% - 15px); min-height: 100px;"></textarea>
            </div>
            <div style="color: #606569;">
                <h4>Typ</h4>
                <select name="type" id="type">
                    <option value="sidebyside">Side by Side</option>
                    <option value="imagebelow">Image below</option>
                </select>
            </div>
            <div style="color: #606569;">
                <h4>Bild</h4>
                <input type="text" name="image" id="image" style="width: calc(100% - 15px);">
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Spara</button>
        </form>
    </div>
</div>

<div class="panel">
    <div class="sidescrollcontent">
        <h2>Hantera FAQs</h2>
        <hr>
        <table style="color: #606569; white-space: normal;" class="table table-hover">
            <thead>
                <th>Fråga</th>
                <th>Svar</th>
                <th>Redigera</th>
                <th>Radera</th>
            </thead>
            <tbody>
                @foreach ($faqs as $faq)
                    <tr>
                        <td>{{$faq->question}}</td>
                        <td>{{$faq->answer}}</td>
                        <td><a href="/admin/editfaq/{{$faq->id}}" class="btn btn-info">Redigera</a></td>
                        <td><a href="/admin/removefaq/{{$faq->id}}" class="btn btn-danger">Ta bort</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="/admin/editfaq" method="POST">
            {{ csrf_field() }}
            <div style="color: #606569;">
                <h4>Fråga</h4>
                <input type="text" name="question" id="question" style="width: calc(100% - 15px);">
            </div>
            <div style="color: #606569;">
                <h4>Brödtext</h4>
                <textarea type="text" name="answer" id="answer" style="width: calc(100% - 15px); min-height: 100px;"></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Spara</button>
        </form>
    </div>
</div>

<div class="panel">
    <div class="sidescrollcontent">
        <h2>Hantera kontakter</h2>
        <hr>
        <table style="color: #606569; white-space: normal;" class="table table-hover">
            <thead>
                <th>Grupp</th>
                <th>Namn</th>
                <th>Kontaktuppgift</th>
                <th>Redigera</th>
                <th>Radera</th>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{$contact->group}}</td>
                        <td>{{$contact->name}}</td>
                        <td>{{$contact->contact_info}}</td>
                        <td><a href="/admin/editcontact/{{$contact->id}}" class="btn btn-info">Redigera</a></td>
                        <td><a href="/admin/removecontact/{{$contact->id}}" class="btn btn-danger">Ta bort</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <form action="/admin/editcontact" method="POST">
            {{ csrf_field() }}
            <div style="color: #606569;">
                <h4>Grupp <p>Alla med samma grupp kommer hamna under samma rubrik</p></h4>
                <input type="text" name="group" id="group" style="width: calc(100% - 15px);">
            </div>
            <div style="color: #606569;">
                <h4>Namn</h4>
                <input type="text" name="name" id="name" style="width: calc(100% - 15px);">
            </div>
            <div style="color: #606569;">
                <h4>Kontaktuppgift</h4>
                <input type="text" name="contact_info" id="contact_info" style="width: calc(100% - 15px);">
            </div>

            <button type="submit" class="btn btn-primary" style="margin-top: 50px;">Spara</button>
        </form>
    </div>
</div>

@endsection