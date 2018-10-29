<div class="js-cookie-consent cookie-consent">
    <div class="fixed-bottom cookiestyle centerTextInDiv">
        <span class="cookie-consent__message">
            {!! trans('cookieConsent::texts.message') !!}
        </span>
        
        <a href="/gdpr" class="whiteColor" style="margin: 0px; padding: 0px;"><br>Läs mer om GDPR</a>
        
        <button class="js-cookie-consent-agree cookie-consent__agree btn btn-white" style="margin-left: 15px; ">
            <p style="margin: 0px; padding: 0px;">{{ trans('cookieConsent::texts.agree') }}</p>
        </button>
    </div>
</div>
