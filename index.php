<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/w3.css">
    <script src="css/jquery.js"></script>
    <script src="css/bootstrap.bundle.js"></script>
    <title>Document</title>
</head>
<body class="bg-light">
    <div class="container">
        <div id="edit">

        </div>
        <div class="row mt-3">
            <div class="col-10 mx-auto">
            <div class="card w3-border-blue">
                <div class="card-header w3-border-amber"><span class="w3-xxlarge" style="color:brown">What you will do today!</span>
                    <button class="btn btn-danger float-right mt-2 w3-hover-shadow" id="clear_all">Clear all</button>
                    <button class="btn btn-info float-right mt-2 mx-2 w3-hover-shadow"" data-toggle="modal" id="add_action_btn" data-target="mymodal">Add Action</button>
                </div>
<!--                All the list goes here-->
<!--                the list is comming fromload_all_data_from_database file-->
                <div class="card-body overflow-auto" id="main-div" style="height:450px">

                </div>
            </div>
            </div>
        </div>
    </div>
<!--    This is the modal useing at we all be adding action to our list-->
    <div class="modal" id="mymodal" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Add Action</h2>
                    <button class="close">
                        <span id="hide_modal">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" autocomplete="off" placeholder="Add Action To list" id="message" class="form-control w3-input w3-animate-input  bg-wh">
                <div class="modal-footer">
                    <input type="button" class="btn btn-success w3-hover-shadow w3-animate-zoom add_btn" value="Add Action" />
                    <button class="btn btn-danger w3-hover-shadow w3-animate-zoom" id="hide_modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<!--        scripts-->
    <script>
        //edit btn clicked
        $(document).on('click','#edit-btn',function (){
            var id = $(this).data('id');
            $.ajax({
                url:'show_edit_window.php',
                type:'POST',
                data:{id:id},
                success:function (response){
                    $('#edit').html(response);
                    $('#editmodal').show();

                    // $('.add_btn').val('Update Action');
                    // $('.modal-title').html("Update Action");
                    // $('.add_btn').attr("data-id",id);
                    // $('.add_btn').attr("id","update_btn");
                    // $('#message').val(response);
                }
            });
        });

        //update action
        $(document).on('click','.update_btn',function (){
            var message = $('#edit_message').val();
            if (message == null || message == ''){
                alert('please fill all fields!');
                return false;
            }
            var date = new Date();
            var id = $('#update_btn').data('id');
            let now = date.getFullYear()+'/'+date.getDate()+'/'+date.getMonth()+' | '+date.getHours() + ' : ' + date.getMinutes() + ' : '+ date.getSeconds();
            $.ajax({
                url:'update_action.php',
                type:'POST',
                data:{message:message , id: id,now:now},
                success:function (response){
                  load_all_data_from_database();
                  $('#edit_message').val('');
                  $('#editmodal').hide();
                }
            });
        });

        //hide modal
        $(document).on('click','#hide_modal',function (){
            $('#message').val('');
            $('#mymodal').hide();
        });
        //hide edit modal
        $(document).on('click','#hide_edit_modal',function (){
            $('#edit_message').val('');
            $('#editmodal').hide();
        });

        // this will clear the hode list
        $(document).on('click','#clear_all',function(){
            if (confirm("do you want to delete all data!")){
                $.ajax({
                    url: 'delete_all_data.php',
                    type:'POST',
                    success:function (response){
                        load_all_data_from_database();
                    }
                });
            }
        });

        // this function  will load all data of list from database
        function load_all_data_from_database(){
            $.ajax({
                url:'load_all_data_from_database.php',
                type:'POST',
                success:function (response){
                    $('#main-div').html(response);
                }
            });
        }

        // we call this function  for loading the data when the page is loaded
        load_all_data_from_database();

        //this btn will show the add action modal
        $(document).on('click','#add_action_btn',function (){
            $('#mymodal').show();
            $('.modal-title').html("Add Action");
            $('.add_btn').val('Add Action');
            $('.add_btn').attr("id","add_btn");
        });

        //this function is for inserting data to list
       $(document).on('click','#add_btn',function (){
           var message = $('#message').val();
            if (message == null || message == ''){
                alert('please fill all fields!');
                return false;
            }
           var date = new Date();
           var now = date.getFullYear()+'/'+date.getDate()+'/'+date.getMonth()+' | '+date.getHours() + ' : ' + date.getMinutes() + ' : '+ date.getSeconds();
           $.ajax({
               url:'insert_data.php',
               type:"POST",
               data:{message : message , now: now},
               success: function (response){
                   // we call this function for loading the current data from database
                   load_all_data_from_database();
                   $('#message').val('');
                   $('#mymodal').hide();

               }
           });
        });

        // this function will delete actions one by one from the list
        $(document).on('click','#delete_btn',function (){
           var id = $(this).data('id');
           if (confirm("do you realy want to delete this record ?")){
               $.ajax({
                  url:'delete_data.php',
                  type:'POST',
                  data: {
                      id: id
                  } ,
                   success: function (response){
                      // we call this function  for loading the remaning data of the list
                      load_all_data_from_database();
                   }
               });
           }
        });
    </script>
</body>
</html>