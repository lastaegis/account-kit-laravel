<!-- HTTPS required. HTTP will give a 403 forbidden response -->
<script src="https://sdk.accountkit.com/en_US/sdk.js"></script>
<script>
    // initialize Account Kit with CSRF protection
    AccountKit_OnInteractive = function(){
        AccountKit.init(
            {
                appId:"1953168228253948",
                state:"{!! csrf_token() !!}",
                version:"v1.1",
                fbAppEventsEnabled:true,
                debug:true
            }
        );
    };

    // login callback
    function loginCallback(response) {
        console.log(response);
        if (response.status === "PARTIALLY_AUTHENTICATED") {
            document.getElementById("code").value = response.code;
            document.getElementById("csrf").value = response.state;
            document.getElementById("login_success").submit();
        }
        else if (response.status === "NOT_AUTHENTICATED") {
            // handle authentication failure
        }
        else if (response.status === "BAD_PARAMS") {
            // handle bad parameters
        }
    }

    // phone form submission handler
    function smsLogin() {
        AccountKit.login(
            'PHONE',
            {},
            loginCallback
        );
    }


    // email form submission handler
    function emailLogin() {
        AccountKit.login(
            'EMAIL',
            {},
            loginCallback
        );
    }
</script>
</body>
</html>