@extends('Layouts/AdminTemplate')
@section('adminContent')
<div class="panel">
    <div class="centerTextInDiv">
        <h1>Hantera {{$user->name}}</h1>
    </div>
    <div>
        <h3>Behörigheter</h3>

        <form method="POST" action="/admin/manageuser/user/done/{{$user->id}}">
            {{ csrf_field() }}
            <div style="display: flex; flex-wrap:wrap;">

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Admin</label>
                    <input type="checkbox" value="1" name="admin" id="admin" @if($access->admin) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Hantera Läger</label>
                    <input type="checkbox" value="1" name="manage_camp" id="manage_camp" @if($access->manage_camp) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Allergi</label>
                    <input type="checkbox" value="1" name="allergy" id="allergy" @if($access->allergy) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Övrigt</label>
                    <input type="checkbox" value="1" name="other" id="other" @if($access->other) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Köket</label>
                    <input type="checkbox" value="1" name="kitchen" id="kitchen" @if($access->kitchen) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Schema</label>
                    <input type="checkbox" value="1" name="schedule" id="schedule" @if($access->schedule) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Game Of Thrones</label>
                    <input type="checkbox" value="1" name="game_of_thrones" id="game_of_thrones" @if($access->game_of_thrones) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Lägga till användare</label>
                    <input type="checkbox" value="1" name="add_user" id="add_user" @if($access->add_user) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">hantera användare</label>
                    <input type="checkbox" value="1" name="manage_user" id="manage_user" @if($access->manage_user) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Se statestik</label>
                    <input type="checkbox" value="1" name="statistics" id="statistics" @if($access->statistics) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Redigera anmälningar</label>
                    <input type="checkbox" value="1" name="edit_registration" id="edit_registration" @if($access->edit_registration) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Verifierad anmälan</label>
                    <input type="checkbox" value="1" name="verified_registration" id="verified_registration" @if($access->verified_registration) checked @endif>
                </div>
                
                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Ålder/ Födelsedag</label>
                    <input type="checkbox" value="1" name="age" id="age" @if($access->age) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">kontakt uppgifter</label>
                    <input type="checkbox" value="1" name="contact_info" id="contact_info" @if($access->contact_info) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">kontakt uppgifter anhörig/ målsman</label>
                    <input type="checkbox" value="1" name="contact_info_advocate" id="contact_info_advocate" @if($access->contact_info_advocate) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Ljung</label>
                    <input type="checkbox" value="1" name="ljung" id="ljung" @if($access->ljung) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Vårgårda</label>
                    <input type="checkbox" value="1" name="vargarda" id="vargarda" @if($access->vargarda) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Asklanda/ Ornunga</label>
                    <input type="checkbox" value="1" name="asklanda_ornunga" id="asklanda_ornunga" @if($access->asklanda_ornunga) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Bergstena/ Östadkulle</label>
                    <input type="checkbox" value="1" name="bergstena_ostadkulle" id="bergstena_ostadkulle" @if($access->bergstena_ostadkulle) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Ljurhalla</label>
                    <input type="checkbox" value="1" name="ljurhalla" id="ljurhalla" @if($access->ljurhalla) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Tåstorp/ Rensvist/ Eggvena/ Lagmansholm</label>
                    <input type="checkbox" value="1" name="t_r_e" id="t_r_e" @if($access->t_r_e) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Borgstena/ Tämta</label>
                    <input type="checkbox" value="1" name="borgstena_tamta" id="borgstena_tamta" @if($access->borgstena_tamta) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Storsjöstrand</label>
                    <input type="checkbox" value="1" name="storsjostrand" id="storsjostrand" @if($access->storsjostrand) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Herrljunga</label>
                    <input type="checkbox" value="1" name="herrljunga" id="herrljunga" @if($access->herrljunga) checked @endif>
                </div>

                <div style="margin: 10px;">
                    <label style="vertical-align:middle;">Personummer</label>
                    <input type="checkbox" value="1" name="persnr" id="persnr" @if($access->persnr) checked @endif>
                </div>
            </div>
            
            <div class="container-fluid d-flex justify-content-center">
                <button type="submit" class="buttonStyle"><p>spara</p></button>
            </div>
        </form>
    </div>
</div>
@endsection