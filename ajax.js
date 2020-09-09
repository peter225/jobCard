var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange=function(){

            if(this.readyState==4  && this.status==200 ){

                 handleAjaxResponse( this.response );
            }
        }

        xhttp.responseType = 'json';

        xhttp.open("POST", "/Login/loginUser", true);

        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.setRequestHeader("Accept", "application/json");
        
        xhttp.send("username=" + userName + "&psw=" + password + "&role=" + role + "&submit-btn=true" );


