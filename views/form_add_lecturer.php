<div class="container rounded mt-5 pt-3 pb-3" style="border:1px solid black" >
  
  <form action="./?p=action_add_lecturer" method="post">

    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Add new lecturer</h4>
    </div>  

    <div class="form-group">
      <label for="lecturer_id">Lecturer ID</label>
      <input type="number" step="1"  maxlength="7" max="9999999" class="form-control" id="lecturer_id" name="lecturer_id" placeholder="Enter lecturer ID" required="true">
    </div>

    <div class="form-group">
      <label for="first_name">First Name</label>
      <input required type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" required="true">
    </div>

    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input required type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" required="true">
    </div>

    <div class="form-group">
      <label for="gender">Gender</label>
      <select class="form-control" id="gender" name="gender" required='true'>
		    <option value="" selected disabled hidden>Please select</option>
          <option>M</option>
          <option>F</option>
      </select>
    </div>

    <div class="form-group">
      <label for="age">Age</label>
      <input required type="number" step="1" maxlength="3" max ="120" class="form-control" id="age" name="age" placeholder="Age" required="true">
    </div> 

    <div class="form-actions"> 
      <button type="submit" class="btn btn-primary">Submit</button>
      <a href="javascript:history.go(-1)" id="cancel" name="cancel" class="btn btn-secondary">Cancel</a>
    </div>

  </form>
  
</div>