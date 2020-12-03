<?php
include "config.php";
$id = $_POST['id'];
$query = "SELECT * FROM to_do_list.list WHERE id = $id";
$result = mysqli_query($conn,$query) or die('got an error!!'.mysqli_error($conn));
if (mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
   echo  '<div class="modal " id="editmodal" >
        <div class="modal-dialog w3-animate-zoom">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">Update Action</h2>
                    <button class="close">
                        <span id="hide_edit_modal">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" autocomplete="off" id="edit_message" class="form-control w3-input w3-animate-input  bg-wh" value="'.$row['message'].'">
                <div class="modal-footer">
                    <input type="button" class="btn btn-success w3-hover-shadow w3-animate-zoom update_btn" id="update_btn" data-id="'.$row['id'].'" value="update Action" />
                    <button class="btn btn-danger w3-hover-shadow w3-animate-zoom" id="hide_edit_modal">Close</button>
                </div>
            </div>
        </div>
    </div>';
}