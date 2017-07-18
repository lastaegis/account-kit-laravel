@include("header")
<input value="+1" id="country_code" />
<input placeholder="phone number" id="phone_number"/>
<button onclick="smsLogin();">Login via SMS</button>
<div>OR</div>
<input placeholder="email" id="email"/>
<button onclick="emailLogin();">Login via Email</button>

<form id="login_success" method="post" action="{{ URL("/login-success") }}">
    {!! csrf_field() !!}
    <input id="csrf" type="hidden" name="csrf" />
    <input id="code" type="hidden" name="code" />
</form>

@include("footer")