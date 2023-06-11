<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>
        
        
        
        
        <div class="container">
            <div class="row">
                <div class="col-lg-6">

                    <div id="status" >
                        Login Here!<br>
                        <button class="btn btn-success" onclick="javascript:login();"><img src="http://hayageek.com/examples/oauth/facebook/oauth-javascript/LoginWithFacebook.png" style="cursor:pointer;" onclick="Login()"/></button>
                        <br>

                        <button class="btn btn-success" onclick="javascript:getname();">get name</button><br>
                        <button class="btn btn-success" onclick="javascript:uploadOnPage();">Upload On Page</button>
                    </div>
                </div>
            </div>

        </div>
        
            
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/peerjs/0.3.9/peer.min.js"></script>




    <script>

        window.fbAsyncInit = function() {
                FB.init({
                appId: '490603447946097',
                status: true,
                cookie: true,
                xfbml: true
            });
        };
        
          
        

        // Load the SDK asynchronously
        (function(d){
            var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement('script'); js.id = id; js.async = true;
            js.src = "//connect.facebook.net/en_US/all.js";
            ref.parentNode.insertBefore(js, ref);
        }(document));
        
        // check login?
        FB.login(function(response) {

                // handle the response
                alert(response);
                console.log("successfully logged in!");

                }, 
                {scope: 'user_birthday', return_scopes: true}
                    
            ); 

        function login() {
            FB.login(function(response) {

                // handle the response
                alert("Already  logged in!");
                console.log("successfully logged in!");

                }, 
                {scope: 'user_birthday', return_scopes: true}
                    
            );            
        }

        function logout() {
            FB.logout(function(response) {
              // user is now logged out
            });
        }

        var status = FB.getLoginStatus();

        console.log(status);

        </script>
        
        



<script>
    
    
 function getname(){
     FB.api('/me', 
        {
            fields: 'last_name, first_name, birthday'
        }, 
        function(response) {
            console.log(response.first_name+"  "+ response.last_name+"  "+response.birthday  );
            alert(response.first_name+"  "+ response.last_name+"  "+response.birthday  );


        });
 }
 
 
 function uploadOnPage(){
    
    
    FB.api(
    "/1363822270416958/feed",
    "POST",
    {
        "message": "This is a test message"
    },
    function (response) {
         console.log(response);
      if (response && !response.error) {
       
      }
    }
);
     
 }
 




</script>