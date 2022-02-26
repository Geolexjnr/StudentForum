

<!-- Button trigger modal -->
<button type="button" class="rounded-pill btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Edit
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" style="width: 40rem;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     <?php 
      include('connection.php');
      $id = $_POST['cid'];
      $c_author = $_POST['c_author'];
      $date = $_POST['date'];
      $message =  mysqli_real_escape_string($connect, $_POST['message']); 

      //$query = mysqli_query($connect, "SELECT * FROM comments WHERE topic_id = '".$topic_id."'");

      echo "
     
        <div class='modal-body d-flex justify-content-center'>
          <div class='d-flex justify-content-center'>
                <div class='text-center my-3' style='width: 35rem; display:flex; flex-wrap:wrap'>
                      <form action='".editComments($connect)."' method='POST'>
                      <input type='hidden' class='form-control' name='c_author' value ='".$id."'>    
                          <input type='hidden' class='form-control' name='c_author' value ='".$_SESSION['username']."'>
                          <input type='hidden' class='form-control' name='date' value='".date('Y-m-d H:i:s')."'>
              
                      <div class='mb-3'>
                          <textarea class='form-control' style='width: 35rem; height: 5rem; resize: none;'
                          name='message' value=''></textarea>
                      </div>
                      
                      <button name='commentSubmit' type='submit' class='rounded-pill btn btn-outline-primary text-left' name='post_topic'>Comment</button>
              
                      </form>
              
                  
                </div>
          </div>
        </div>
        ";
      ?>
      <div class="modal-footer">
        <button type="button" class="rounded-pill btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="rounded-pill btn btn-outline-success">Save changes</button>
      </div>
    </div>
  </div>
</div>