 function verifyAttempt() {
     $.ajax({
         url: "login/Login.php",
         type: 'post',
         success: function(data) {
             console.log(data);
             alert(data);
         },
         error: function(data) {
             console.log(data);
             alert(data);
         }
     });
 }