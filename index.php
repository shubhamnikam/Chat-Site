
<html>
  <head>
       <title>Chat Website</title>
       <link rel="stylesheet" href="style.css">
       <link rel="stylesheet" href="bootstrap.css">
       <script src="jquery.js">

       </script>

       <script src="https://www.gstatic.com/firebasejs/4.3.0/firebase.js"></script>
       <script>
         // Initialize Firebase
         var config = {
           apiKey: "AIzaSyAHtY_v3ZoaAm5W9KxWQhhw-spnuEwwmnw",
           authDomain: "chat-web-c9373.firebaseapp.com",
           databaseURL: "https://chat-web-c9373.firebaseio.com",
           projectId: "chat-web-c9373",
           storageBucket: "chat-web-c9373.appspot.com",
           messagingSenderId: "29631350538"
         };
         firebase.initializeApp(config);

                     var name = "";


                     $(document).ready(function(){

                         firebase.database().ref('chat/').on('child_added', function(snapshot){
                             var data = "<div id = 'm'><p class = 'name'>" + snapshot.child('name').val() + "</p><p class = 'message'>" + snapshot.child('message').val() + "</p></div>";

                             $("#messages").html($("#messages").html() + data);
                         });

                         $("#name_submit").on('click', function(){
                             name = $("#name").val();
                             $("#name_prompt_parent").fadeOut();

                             firebase.database().ref('chat/' + Date.now()).set({
                                 name: "",
                                 message: "<i>" + name + " joined the chatroom</i>"
                             });
                         });

                         $("#send_button").on('click', function(){
                             var mess = $("#msg").val();

                             firebase.database().ref('chat/' + Date.now()).set({
                                 name: name,
                                 message: mess
                             });

                             $("#msg").val("");
                         });

                     });

                 </script>
             </head>

             <body>
                 <div id = "name_prompt_parent">
                     <div id = "name_prompt">
                         <p class = "title">Hey There ! Why don't you say us your name ?</p>
                         <input type = "text" id = "name" class = "form-control">
                         <br>
                         <button id = "name_submit" class = "btn btn-success">Submit</button>
                     </div>
                 </div>

                 <div id = "chatroom">
                     <div id = "messages">

                     </div>
                     <div id = "input">
                         <textarea id = "msg" class = "form-control" id = "message"></textarea>
                         <button id = "send_button" class = "btn btn-primary">Send</button>
                     </div>
                 </div>

             </body>
         </html>
